<div class="container-fluid" style="background-color: #006432;">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="{{ route('guest.index') }}" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold px-3 mr-1" style="color: #fefefe !important">L’Essence</span></h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="">
                <div class="position-relative">
                    <input type="text" class="form-control rounded-3 ps-5" placeholder="Tìm sản phẩm" style="border-radius: 15px;">
                    <i class="fa fa-search position-absolute text-muted" style="top: 50%; right: 15px; transform: translateY(-50%);"></i>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{ route('guest.liked.index') }}" class="btn" style="color: #fefefe !important">
                <i class="fas fa-heart"></i>
                <span class="badge">{{ $quantityLiked }}</span>
            </a>
            <a href="{{ route('guest.cart.index') }}" class="btn" style="color: #fefefe !important">
                <i class="fas fa-shopping-cart"></i>
                <span class="badge">{{ $quantityCart }}</span>
            </a>
        </div>
    </div>
</div>
