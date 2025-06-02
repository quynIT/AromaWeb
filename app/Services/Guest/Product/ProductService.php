<?php

namespace App\Services\Guest\Product;

use App\Enums\TypeImgEnum;
use App\Models\Product;
use App\Models\ProductSize;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;

class ProductService extends BaseService
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getListProduct($request)
    {
        $lisProduct = $this->model->where('status', '1')->join('brands', 'brands.id', 'products.brand_id')
            ->join('categories', 'categories.id', 'products.category_id')
            ->select(DB::raw('products.*,brands.name as namebrand,categories.name as namecategories'))
            ->with(['Img', 'ProductSize' => function ($q) {
                $q->with('Img');
            }])->whereHas('ProductSize');
        if ($request->input('categories'))
            $lisProduct->where('category_id', $request->input('categories'));
        if ($request->input('brands')) {
            $brands = explode('-', $request->input('brands'));
            $lisProduct->whereIn('brand_id', $brands);
        }
        if ($request->input('name')) {
            $lisProduct->where('products.name', 'like', '%' . $request->input('name') . '%');
        }
        return $lisProduct->get()->toArray();
    }

    public function getDataDetail($request)
{
    // Validate the request parameters
    if (!$request->slug || !$request->size || !$request->type) {
        return [
            'success' => false,
            'error' => 'Invalid request parameters.'
        ];
    }

    // Fetch the product by slug
    $product = $this->model->where('slug', $request->slug)
        ->with(['Img', 'ProductSize' => function ($q) {
            $q->with('Img', 'ProductColor');
        }])->first();

    // Check if the product exists
    if (!$product) {
        return [
            'success' => false,
            'error' => 'Product not found.'
        ];
    }

    $product = $product->toArray();
    $category_id = $product['category_id'];
    $brand_id = $product['brand_id'];

    // Fetch the product size
    $productSize = ProductSize::where('size', $request->size)
        ->where('type_size', $request->type)
        ->where('product_id', $product['id'])
        ->first();

    // Check if the product size exists
    if (!$productSize) {
        return [
            'success' => false,
            'error' => 'Product size not found.'
        ];
    }

    // Fetch related products
    $relateProduct = array_filter(Product::where('slug', '!=', $request->slug)
        ->with(['ProductSize', 'Img', 'Category', 'Brand'])
        ->whereHas('ProductSize')
        ->where('status', '1')
        ->whereRaw("category_id=$category_id or brand_id=$brand_id")
        ->get()->toArray(), function ($e) {
        return $e['product_size'];
    });

    // Check if the product has the required relationships
    if ($product && $product['product_size'] && $productSize) {
        return [
            'success' => true,
            'data' => [
                'product' => $product,
                'idSize' => $productSize->id,
                'size' => $request->size,
                'typeSize' => $request->type,
                'color' => $request->color ?? 0,
                'relateProduct' => $relateProduct
            ]
        ];
    } else {
        return [
            'success' => false,
            'error' => 'Product details not found.'
        ];
    }
}
}
