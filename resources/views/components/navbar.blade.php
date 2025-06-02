<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1 rounded">E</span>Shopper</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="{{ route('guest.index') }}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-home me-1"></i> Trang chủ
            </a>
            <a href="{{ route('guest.shop') }}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-store me-1"></i> Sản phẩm
            </a>
            <a href="{{ route('guest.contact.index') }}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-envelope me-1"></i> Liên hệ
            </a>
            <a href="{{ route('guest.about.index') }}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-info-circle me-1"></i> Giới thiệu
            </a>
            <a href="{{route('guest.about.helpp') }}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-question-circle me-1"></i> Hướng dẫn mua hàng
            </a>
            <a href="{{route('guest.coupon.index')}}" class="nav-item nav-link fw-medium hover-underline-animation mx-2">
                <i class="fas fa-tags me-1"></i> Phiếu giảm giá
            </a>
        </div>
        <div class="navbar-nav ml-auto py-0">
            @if (Auth::check())
            <div class="dropdown">
                <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth()->user()->name }}
                </button>
                <div class=" dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item py-2" href="{{ route('guest.account.index') }}">
                        <i class="fas fa-user-circle me-2"></i> Thông tin
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            @else
            <a href="{{ 'login' }}" class="nav-item nav-link"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
            <a href="{{ 'register' }}" class="nav-item nav-link"> <i class="fas fa-user-plus me-1"></i>Register</a>
            @endif
        </div>
    </div>
</nav>


<style>
    /* Thêm hiệu ứng hover cho các liên kết */
    .hover-underline-animation {
        position: relative;
    }
    
    .hover-underline-animation::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--bs-primary);
        transition: width 0.3s ease-in-out;
    }
    
    .hover-underline-animation:hover::after {
        width: 100%;
    }
    
    /* Làm mềm các góc và thêm hiệu ứng hover cho các nút */
    .navbar .btn {
        transition: all 0.3s ease;
    }
    
    .navbar .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    /* Cải thiện dropdown menu */
    .dropdown-menu {
        transition: all 0.2s ease-in-out;
    }
    
    .dropdown-item {
        transition: background-color 0.2s ease;
    }
    
    .dropdown-item:hover {
        background-color: rgba(13, 110, 253, 0.1);
    }
    </style>