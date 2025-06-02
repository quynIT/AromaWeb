<?php

namespace App\Services\Guest\Cart;

use App\Enums\TypeImgEnum;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Throwable;

class CartService extends BaseService
{
    public function __construct(Cart $cart)
    {
        $this->model = $cart;
    }

    public function getDataCart()
{
    $data = Cart::with([
        'ProductColor',
        'ProductColor.ProductSize',
        'ProductColor.ProductSize.Product',
        'ProductColor.ProductSize.Img'
    ])->where('user_id', auth()->user()->id)->get()->toArray();
    return $data;
}

    public function getDataCartProduct()
    {
        $data = Cart::with(['ProductSize'])->where('user_id', auth()->user()->id)->where('carts.quantity', '>', 0)->get()->toArray();
        return $data;
    }
    
    public function addToCart($idProduct, $quantity)
{
    try {
        DB::beginTransaction();
        $quantity = intval($quantity);
        
        // First check if product color exists
        $productColor = ProductColor::where('id', $idProduct)->first();
        if (!$productColor) {
            return ['success' => false, 'error' => 'Màu sản phẩm không tồn tại'];
        }
        
        // Then get the product
        $product = Product::where('id', $idProduct)->first();
        if (!$product) {
            // There seems to be confusion between product ID and product color ID
            // Let's try to get the product ID from the product_size table related to this color
            $productSizeId = $productColor->product_size_id;
            $productSize = ProductSize::where('id', $productSizeId)->first();
            if (!$productSize) {
                return ['success' => false, 'error' => 'Không tìm thấy thông tin sản phẩm'];
            }
            $product_id = $productSize->product_id;
        } else {
            $product_id = $product->id;
        }
        
        $userId = auth()->user()->id;
        
        if (!is_numeric($quantity)) {
            return ['success' => false, 'error' => 'Số lượng không hợp lệ'];
        }
        
        if ($quantity > $productColor->quantity) {
            return ['success' => false, 'error' => 'Số hàng mua đã vượt quá số lượng trong kho'];
        }
        
        if ($quantity < 0) {
            return ['success' => false, 'error' => 'Số lượng không được âm'];
        }
        
        $cart = $this->model->where('user_id', $userId)->where('product_color_id', $idProduct)->first();
        if (!$cart) {
            $cart = $this->model;
            $cart->quantity = $quantity;
            $cart->user_id = $userId;
            $cart->product_color_id = $productColor->id;
            $cart->product_id = $product_id;
        } else {
            $cart->quantity = $cart->quantity + $quantity;
        }
        
        $cart->save();
        $productColor->quantity = $productColor->quantity - $quantity;
        $productColor->save();
        DB::commit();
        
        return ['success' => true, 'data' => [
            'quantityInStock' => $productColor->quantity,
            'id' => $idProduct,
            'quantity' => $quantity,
            'totalQuantity' => $this->totalQuantity()
        ]];
    } catch (Throwable $e) {
        DB::rollBack();
        // Instead of dd($e), let's log the error and return a friendly message
        \Log::error($e->getMessage());
        return ['success' => false, 'error' => 'Thất bại: ' . $e->getMessage()];
    }
}

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $productCart = $this->model->where('id', $id)->first();
            if (!$productCart) return ['success' => false, 'error' => 'Thất bại'];
            $productColor = ProductColor::where('id', $productCart->product_color_id)->first();
            $productColor->quantity = $productColor->quantity + $productCart->quantity;
            $productColor->save();
            $productCart->delete();
            DB::commit();
            return ['success' => true, 'message' => 'Thành công', 'data' => [
                'totalPrice' => $this->totalPrice(), 'delete' => 1,
                'totalQuantity' => $this->totalQuantity()
            ]];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function update($quantity, $id)
    {
        try {

            $productCart = $this->model->where('id', $id)->first();
            if (!$productCart || !is_numeric($quantity) || $quantity < 0) {
                return ['success' => false, 'error' => 'Thất bại'];
            }
            if ($quantity <= 0) {
                return $this->delete($productCart->id);
            } else {
                DB::beginTransaction();
                $productColor = ProductColor::where('id', $productCart->product_color_id)->first();
                $quantityInStock = $productColor->quantity;
                if (($quantityInStock + $productCart->quantity) < $quantity) {
                    return ['success' => false, 'error' => 'Vượt quá số lượng cho phép'];
                }
                $productColor->update(['quantity' => $quantityInStock + $productCart->quantity - $quantity]);
                $productCart->update([
                    'quantity' => $quantity
                ]);
                DB::commit();
                return [
                    'success' => true, 'message' => 'Thành công',
                    'data' => [
                        'quantity' => $quantity, 'quantityInStock' => $productColor->quantity,
                        'price' => ProductSize::where('id', $productColor->product_size_id)->first()->price_sell,
                        'totalPrice' => $this->totalPrice(),
                        'totalQuantity' => $this->totalQuantity()
                    ]
                ];
            }
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }

    public function totalPrice()
    {
        return Cart::where('carts.user_id', auth()->user()->id)
    ->join('product_color', 'product_color.id', 'carts.product_color_id')
    ->join('product_size', 'product_size.id', 'product_color.product_size_id')
    ->sum(DB::raw('carts.quantity*product_size.price_sell'));
    }

    public function totalQuantity()
    {

        if (!auth()->check()) {
            return 0;
        } else
        return Cart::where('carts.user_id', auth()->user() ? auth()->user()->id : 0)
        ->join('product_color', 'product_color.id', 'carts.product_color_id')
        ->join('product_size', 'product_size.id', 'product_color.product_size_id')
        ->sum(DB::raw('carts.quantity')) ?? 0;
    }

    public function getDiscount($discountCode)
    {
        try {
            $message = '';
            $discountPrice = 0;
            $discount = Discount::where('code', $discountCode)->where('status', 0)
                ->join('discount_user', 'discount_user.discount_id', 'discounts.id')
                ->where('discount_user.user_id', auth()->user()->id)
                ->whereDate('begin', '<=', date('Y-m-d'))
                ->whereDate('end', '>=', date('Y-m-d'))->first();
            if ($discount) {
                if ($discount->price >= $this->totalPrice()) {
                    $message = [
                        'message' => 'Giá trị đơn hàng tối thiểu phải là ' . $discount->price . ' đ',
                        'icon' => 'warning'
                    ];
                    $discountCode = '';
                } else {
                    $message = [
                        'message' => 'Áp dụng mã giảm giá thành công',
                        'icon' => 'success'
                    ];
                    $discountPrice = $discount->price;
                    $discountCode = $discount->code;
                }
            } else {
                $discountCode = '';
                $message = [
                    'message' =>
                    'Mã giảm giá không tồn tại',
                    'icon' => 'error'
                ];
            }
            return [
                'success' => true,
                'message' => $message,
                'data' => [
                    'discountCode' => $discountCode,
                    'discountPrice' => $discountPrice,
                ]
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại', 'data' => [
                'discountCode' => $discountCode,
                'discountPrice' => $discountPrice,
            ]];
        }
    }

    public function deleteAll()
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id;
            $this->model->where('user_id', $userId)->delete();
            DB::commit();
            return ['success' => true, 'message' => 'Thành công'];
        } catch (Throwable $e) {
            DB::rollBack();
            return ['success' => false, 'error' => 'Thất bại'];
        }
    }
}
