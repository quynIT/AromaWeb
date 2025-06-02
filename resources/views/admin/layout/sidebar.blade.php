<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu</li>

                <li class="mm-active">
                    <a href="#" class="p-0" style="font-size: 20px">
                        <i class="bi bi-menu-button-wide mr-2"></i>Ứng dụng
                        <i class="bi bi-caret-down-fill"></i>
                    </a>
                    <div class="">
                        <div class="menu-item">
                            <a href="{{ route('admin.index') }}">
                                <i class="bi bi-speedometer2"></i>
                                <span>Dash board</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.banner.index') }}">
                                <i class="bi bi-card-image"></i>
                                <span>Banner</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.product.index') }}">
                                <i class="bi bi-box-seam"></i>
                                <span>Sản phẩm</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.category.index') }}">
                                <i class="bi bi-diagram-3"></i>
                                <span>Phân loại</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.brand.index') }}">
                                <i class="bi bi-tags"></i>
                                <span>Nhãn hàng</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.supplier.index') }}">
                                <i class="bi bi-truck"></i>
                                <span>Nhà cung cấp</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.notification.index') }}">
                                <i class="bi bi-shop"></i>
                                <span>Thông tin cửa hàng</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.customer.index') }}">
                                <i class="bi bi-people"></i>
                                <span>Thông tin khách hàng</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.order.index') }}">
                                <i class="bi bi-cart3"></i>
                                <span>Đơn hàng</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.discount.index') }}">
                                <i class="bi bi-percent"></i>
                                <span>Mã giảm giá</span>
                            </a>
                        </div>
                        
                        <div class="menu-item">
                            <a href="{{ route('admin.mailbox.index') }}">
                                <i class="bi bi-chat-left-text"></i>
                                <span>Lời nhắn của khách hàng</span>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<style>
    /* Reset CSS cho sidebar */
    .custom-sidebar * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    /* Thiết kế cơ bản cho sidebar */
    .custom-sidebar {
        width: 280px;
        height: 100vh;
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: #ffffff;
        position: fixed;
        left: 0;
        top: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
    }
    
    /* Header của sidebar */
    .sidebar-header {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .logo {
        height: 40px;
        width: 120px;
    }
    
    .toggle-button {
        background: transparent;
        border: none;
        cursor: pointer;
        color: white;
        font-size: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Container chính cho nội dung */
    .sidebar-content {
        height: calc(100vh - 70px);
        overflow-y: auto;
    }
    
    .sidebar-inner {
        padding: 20px 15px;
    }
    
    /* Style cho phần tiêu đề menu */
    .menu-heading {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    /* Style cho menu chính */
    .menu-main-container {
        margin-bottom: 20px;
    }
    
    .menu-main-title {
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        margin-bottom: 10px;
        font-size: 20px;
        font-weight: 600;
    }
    
    .menu-main-title i:first-child {
        margin-right: 12px;
        font-size: 22px;
    }
    
    .menu-main-title span {
        flex-grow: 1;
    }
    
    .menu-main-title i:last-child {
        font-size: 14px;
    }
    
    /* Container cho submenu */
    .submenu-container {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        padding: 12px;
        margin-left: 10px;
        display: block; /* Luôn hiển thị, không cần JavaScript */
    }
    
    /* Style cho các menu item */
    .menu-item {
        margin-bottom: 8px;
    }
    
    .menu-item a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 16px;
    }
    .menu-item a{
        padding-left:30px !important; 
    }
    .menu-item a:hover {
        background-color: #05af43 !important;
        color: #ffffff;
        transform: translateX(5px);
    }
    
    .menu-item i {
        margin-right: 15px;
        font-size: 18px;
        min-width: 22px;
        text-align: center;
    }
    
    /* Style cho menu item active */
    .menu-item a.active {
        background-color: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-weight: 600;
        position: relative;
    }
    
    .menu-item a.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background-color: #05af43;
        border-radius: 0 2px 2px 0;
    }
    
    /* Custom scrollbar */
    .sidebar-content::-webkit-scrollbar {
        width: 6px;
    }
    
    .sidebar-content::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.1);
    }
    
    .sidebar-content::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }
    
    .sidebar-content::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    /* Hiệu ứng hover cho menu items */
    .menu-item a::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 15px;
        width: 0;
        height: 2px;
        background-color: rgba(255, 255, 255, 0.4);
        transition: width 0.3s ease;
        opacity: 0;
    }
    
    .menu-item a:hover::after {
        width: calc(100% - 30px);
        opacity: 1;
    }
    /* .vertical-nav-menu li a {
        padding: 0 !important;
    } */
    </style>