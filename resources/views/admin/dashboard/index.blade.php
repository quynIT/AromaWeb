@extends('admin.layout.main')
@section('title', 'Trang danh dashboard')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dashboard-card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 25px;
            border: none;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            width: 64px;
            height: 64px;
            font-size: 26px;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .dashboard-card:hover .card-icon {
            transform: scale(1.1);
        }

        .card-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: rgba(255, 255, 255, 0.9);
        }

        .dashboard-card h6 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            color: #fff;
        }

        .table-card {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
            border: none;
        }

        .table-card .card-title {
            font-size: 18px;
            color: #333;
            padding: 20px 20px 5px;
            border-bottom: none;
            display: flex;
            align-items: center;
        }

        .table-card .card-title i {
            margin-right: 10px;
            color: #4e73df;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            border-top: none;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .rank-badge {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin: 0 auto;
        }

        .rank-1 {
            background-color: #ffc107;
        }

        .rank-2 {
            background-color: #6c757d;
        }

        .rank-3 {
            background-color: #cd7f32;
        }

        .rank-default {
            background-color: #4e73df;
        }

        .customer-name {
            font-weight: 600;
            color: #333;
        }

        .customer-email {
            color: #6c757d;
            font-size: 13px;
        }

        .product-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-img:hover {
            transform: scale(1.05);
        }

        .product-name {
            font-weight: 600;
            color: #333;
        }

        .count-badge {
            background: linear-gradient(45deg, #4e73df, #36b9cc);
            color: white;
            padding: 6px 12px;
            border-radius: 30px;
            font-weight: 600;
            display: inline-block;
        }

        .money-value {
            font-weight: 700;
            color: #28a745;
        }

        .bg-success-gradient {
            background: linear-gradient(135deg, #1cc88a 0%, #20c997 100%);
        }

        .bg-danger-gradient {
            background: linear-gradient(135deg, #e74a3b 0%, #fd7e14 100%);
        }

        .bg-info-gradient {
            background: linear-gradient(135deg, #4e73df 0%, #36b9cc 100%);
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 5px;
        }

        .empty-state {
            padding: 30px;
            text-align: center;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #e0e0e0;
        }
    </style>
@endpush
@section('content')
    <div class="app-main__inner">


        <div class="row">
            <div class="col-md-12">
                <div class="container-fluid px-0">
                    <div class="row">
                        <!-- Sales Card -->
                        <div class="col-xl-4 col-md-4">
                            <div class="card dashboard-card bg-success-gradient">
                                <div class="card-body p-4">
                                    <h2 class="card-title">Đơn đã bán</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </div>
                                        <div>
                                            <h6 id="total_orders">{{ $ordersnumber }}</h6>
                                            <div class="stat-label">Tổng số đơn hàng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Sales Card -->

                        <!-- Revenue Card -->
                        <div class="col-xl-4 col-md-4">
                            <div class="card dashboard-card bg-danger-gradient">
                                <div class="card-body p-4">
                                    <h2 class="card-title">Doanh Thu Tháng</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-circle-dollar-to-slot"></i>
                                        </div>
                                        <div>
                                            <h6 id="total_money">{{ number_format($sales, 0, ',', ',') }} đ</h6>
                                            <div class="stat-label">Tháng hiện tại</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Revenue Card -->

                        <!-- Customers Card -->
                        <div class="col-xl-4 col-md-4">
                            <div class="card dashboard-card bg-info-gradient">
                                <div class="card-body p-4">
                                    <h2 class="card-title">Khách hàng mới</h2>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                        <div>
                                            <h6 id="total_user">{{ $customernumber }}</h6>
                                            <div class="stat-label">Tổng khách hàng</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Customers Card -->

                        <!-- Top Customers -->
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fa-solid fa-trophy"></i> 5 khách hàng mua nhiều
                                        nhất</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Số điện thoại</th>
                                                <th scope="col">Tổng số đơn</th>
                                                <th scope="col">Tổng số tiền</th>
                                            </tr>
                                            </thead>
                                            <tbody id="recent_orders">
                                            @php
                                                $index = 1;
                                            @endphp
                                            @forelse ($topCustomer as $item)
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="rank-badge {{ $index <= 3 ? 'rank-'.$index : 'rank-default' }}">
                                                            {{ $index++ }}
                                                        </div>
                                                    </td>
                                                    <td class="text-left">
                                                        <span class="customer-name">{{ $item['name'] }}</span>
                                                    </td>
                                                    <td class="text-left">
                                                        <span class="customer-email">{{ $item['email'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="customer-email"> {{ $item['phone'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $item['count'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="money-value">{{ number_format($item['totalPrice'], 0, ',', ',') }} đ</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="empty-state">
                                                            <i class="fa-solid fa-database"></i>
                                                            <p>Chưa có dữ liệu khách hàng</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Top Customers -->

                        <!-- Top Products -->
                        <div class="col-12">
                            <div class="card table-card">
                                <div class="card-body pb-0">
                                    <h5 class="card-title"><i class="fa-solid fa-fire"></i> 5 sản phẩm bán chạy nhất
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered text-center">
                                            <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">Ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Tổng số lượng bán</th>
                                            </tr>
                                            </thead>
                                            <tbody id="new_product">
                                            @php
                                                $index = 1;
                                            @endphp
                                            @forelse ($topProduct as $item)
                                                <tr>
                                                    <td>
                                                        <div
                                                            class="rank-badge {{ $index <= 3 ? 'rank-'.$index : 'rank-default' }}">
                                                            {{ $index++ }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <img class="product-img"
                                                             src="{{ asset('storage/Product' . '/' . $item['img'][0]['path']) }}"
                                                             alt="Product image">
                                                    </td>
                                                    <td class="text-left">
                                                        <span class="product-name">{{ $item['name'] }}</span>
                                                    </td>
                                                    <td>
                                                        <span class="count-badge">{{ $item['count'] }} sản phẩm</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        <div class="empty-state">
                                                            <i class="fa-solid fa-box-open"></i>
                                                            <p>Chưa có dữ liệu sản phẩm bán chạy</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Top Products -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
@endsection
@push('js')
    <script>
        // Giữ nguyên logic JavaScript, nếu có
    </script>
@endpush
