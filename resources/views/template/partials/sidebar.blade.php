<aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
    {{-- <h1 id="colorlib-logo">{{ Session::get('data.name') }}<br> --}}
        @if(!empty(Auth::guard('shop')->user()))
            <h1 id="colorlib-logo">{{ Auth::guard('shop')->user()->name }}<br>
                <a href="{{ route('profile.edit.shop', Auth::guard('shop')->user()->saler_id) }}"><span>Edit Profile</span></a>
            </h1>
        @elseif(!empty(Auth::guard('member')->user()))
            <h1 id="colorlib-logo">{{ Auth::guard('member')->user()->name }}<br>
                <a href="{{ route('profile.edit.member', Auth::guard('member')->user()->user_id) }}"><span>Edit Profile</span></a>
            </h1>
        @elseif(!empty(Auth::guard('admin')->user()))
            <h1 id="colorlib-logo">{{ Auth::guard('admin')->user()->name }}<br>
                <a href="{{ route('profile.edit.admin', Auth::guard('admin')->user()->admin_id) }}"><span>Edit Profile</span></a>
            </h1>
        @endif
    {{-- </h1> --}}
    <nav id="colorlib-main-menu" role="navigation">
        {{-- {{ dd(request()->is('website/blacklist')) }} --}}
        <ul>
            <li @if(request()->is('website') || request()->is('website/search/*')) class="colorlib-active" @endif><a href="{{ route('website.home') }}">Home</a></li>
            <li @if(request()->is('website/define')) class="colorlib-active" @endif><a href="{{ route('website.define') }}">นิยาม</a></li>
            <li @if(request()->is('website/shirt-label')) class="colorlib-active" @endif><a href="{{ route('website.shirt.label') }}">ป้ายเสื้อ</a></li>
            <li @if(request()->is('website/blacklist')) class="colorlib-active" @endif><a href="{{ route('website.blacklist') }}">บุคคลที่ควรระวัง</a></li>
            @if(empty(Session::get('data')))
                <li @if(request()->is('login')) class="colorlib-active" @endif><a href="{{ route('login') }}">Login</a></li>
            @else
                @if(!empty(Auth::guard('shop')->user()))
                    <li @if(request()->is('product')) class="colorlib-active" @endif><a href="{{ route('product.index') }}">รายการสินค้า</a></li>
                @elseif(!empty(Auth::guard('member')->user()))
                    {{-- <li @if(request()->is('website/blacklist')) class="colorlib-active" @endif><a href="#">รายการสั่งซื้อสินค้า</a></li> --}}
                @elseif(!empty(Auth::guard('admin')->user()))
                    <li @if(request()->is('type-product')) class="colorlib-active" @endif><a href="{{ route('typeProduct.index') }}">รายการประเภทสินค้า</a></li>
                    <li @if(request()->is('blacklist')) class="colorlib-active" @endif><a href="{{ route('blacklist.index') }}">blacklist</a></li>
                @endif
                <li><a href="{{ route('get.logout') }}">Logout</a></li>
            @endif
        </ul>
    </nav>

    <div class="colorlib-footer">
        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
        <ul>
            <li><a href="#"><i class="icon-facebook"></i></a></li>
            <li><a href="#"><i class="icon-twitter"></i></a></li>
            <li><a href="#"><i class="icon-instagram"></i></a></li>
            <li><a href="#"><i class="icon-linkedin"></i></a></li>
        </ul>
    </div>
</aside> <!-- END COLORLIB-ASIDE -->