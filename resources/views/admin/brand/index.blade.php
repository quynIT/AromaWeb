@extends('admin.layout.main')
@section('title', 'Quản lý thương hiệu')
@section('content')
    <div class="app-main__inner">
        <!-- Dashboard Header Card -->
        <div class="app-page-title mb-4">
            <div class=" position-relative">
                <div class="card shadow-lg border-0 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="bg-gradient-primary text-white py-4 px-4 position-relative">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <div class="page-title-icon bg-white text-primary p-3 rounded-circle mr-3 shadow">
                                        <i class="bi bi-tag"></i>
                                    </div>
                                    <div>
                                        <h3 class="mb-1 font-weight-bold" style="color: #000">Quản lý thương hiệu</h3>
                                        <p class="mb-0 opacity-75">Xem và quản lý các thương hiệu trong hệ thống</p>
                                    </div>
                                </div>
                                <div class="page-title-actions">
                                    <a href="{{ route('admin.brand.create') }}" class="btn btn-light btn-lg shadow-sm">
                                        <span class="d-flex align-items-center">
                                            <i class="bi bi-plus-circle-fill mr-2"></i>
                                            <span>Thêm thương hiệu mới</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="wave-container position-absolute bottom-0 left-0 w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-100" style="height: 40px;">
                                    <path fill="#ffffff" fill-opacity="1" d="M0,32L48,48C96,64,192,96,288,96C384,96,480,64,576,48C672,32,768,32,864,48C960,64,1056,96,1152,96C1248,96,1344,64,1392,48L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Stats -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <form action="#">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-white border-right-0">
                                        <i class="bi bi-search text-primary"></i>
                                    </span>
                                </div>
                                <input type="search" name="q" id="search" placeholder="Nhập tên thương hiệu để tìm kiếm..."
                                    class="form-control border-left-0" value="{{ request()->input('q') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary px-4" name="btn-search">
                                        Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Data Table -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 font-weight-bold text-primary">
                            <i class="bi bi-list-ul mr-2"></i>Danh sách thương hiệu
                        </h5>
                        <span class="badge badge-pill badge-primary px-3 py-2">Tổng: {{ $list_brands->total() }} thương hiệu</span>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center py-3" width="5%">#</th>
                                    <th class="py-3" width="15%">Hình ảnh</th>
                                    <th class="py-3">Tên thương hiệu</th>
                                    <th class="text-center py-3" width="15%">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($list_brands->total() > 0)
                                @foreach ($list_brands as $index => $brand)
                                    <tr>
                                        <td class="text-center">
                                            <span class="font-weight-bold">{{ $index + 1 }}</span>
                                        </td>
                                        <td>
                                            <div class="brand-img-container d-flex justify-content-center">
                                                <div class="brand-img-wrapper rounded bg-light d-flex align-items-center justify-content-center p-2" style="width: 80px; height: 80px;">
                                                    <img class="img-fluid" style="max-height: 60px; max-width: 70px; object-fit: contain;" 
                                                        data-toggle="tooltip" title="{{ $brand->name }}"
                                                        data-placement="bottom"
                                                        src="{{ asset('storage/Brand' . '/' . $brand->img[0]->path) }}"
                                                        alt="{{ $brand->name }}">
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="font-weight-bold text-primary" style="font-size: 16px;">{{ $brand->name }}</span>
                                                <small class="text-muted">ID: #{{ $brand->id }}</small>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.brand.edit', $brand->id) }}" 
                                                   class="btn btn-outline-primary border-0 btn-sm"
                                                   data-toggle="tooltip" title="Chỉnh sửa thông tin">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form class="d-inline"
                                                    action="{{ route('admin.brand.destroy', $brand->id) }}" method="POST">
                                                    @method('Delete')
                                                    @csrf
                                                    <button class="btn btn-outline-danger border-0 btn-sm"
                                                        type="submit" data-toggle="tooltip" title="Xóa thương hiệu"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa thương hiệu \'{{ $brand->name }}\' không?')">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="empty-state d-flex flex-column align-items-center py-4">
                                            <div class="empty-state-icon bg-light text-secondary rounded-circle p-3 mb-3">
                                                <i class="bi bi-inbox-fill" style="font-size: 2rem;"></i>
                                            </div>
                                            <h5>Không tìm thấy thương hiệu nào</h5>
                                            <p class="text-muted">Không có kết quả phù hợp với tiêu chí tìm kiếm của bạn</p>
                                            <a href="{{ route('admin.brand.index') }}" class="btn btn-outline-primary mt-2">
                                                <i class="bi bi-arrow-repeat mr-1"></i> Xem tất cả
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer bg-white py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                @if ($list_brands->total() > 0)
                                    <div class="text-muted">
                                        Hiển thị {{ $list_brands->firstItem() }} đến {{ $list_brands->lastItem() }} 
                                        trên tổng số {{ $list_brands->total() }} thương hiệu
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="pagination-wrapper d-flex justify-content-md-end justify-content-center">
                                    {{ $list_brands->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
    }
    
    .pagination {
        margin-bottom: 0;
    }
    
    .table th, .table td {
        vertical-align: middle;
    }
    
    .brand-img-wrapper {
        transition: all 0.2s ease;
    }
    
    .table tr:hover .brand-img-wrapper {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
    .btn-group .btn {
        transition: all 0.2s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .empty-state-icon {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
        
        // Hiệu ứng fade khi tải trang
        $('.card').addClass('fade-in');
        
        // Flash message nếu có
        if($('.alert').length > 0) {
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        }
    });
</script>
@endpush