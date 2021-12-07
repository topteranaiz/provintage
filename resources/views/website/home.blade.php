@extends('template.master')
@section('content')
{{-- <div class="hero-wrap js-fullheight" style="background-image: url(/template/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="js-fullheight d-flex justify-content-center align-items-center">
        <div class="col-md-8 text text-center">
            <div class="img mb-4" style="background-image: url(/templateimages/author.jpg);"></div>
            <div class="desc">
                <h1 class="mb-4">Double T Vintage</h1>
                <b class="mb-4" style="color:darkblue">ยินดีต้อนรับชุมชนเสื้อวินเทจ</b> 
                <br> <b class="mb-4" style="color:darkblue">ติดต่อได้ที่ Line ID : guygao12 หรือ FB : Sky Trakulto</b>
            </div>
        </div>
    </div>
</div> --}}
<section class="ftco-section" style="background-image: url(/template/images/bg_1.jpg);" data-stellar-background-ratio="0.1">
    <div class="col-md-12 text text-center">
        <div class="img mb-4" style="background-image: url(/templateimages/author.jpg);"></div>
        <div class="desc">
            <h1 class="mb-4">Double T Vintage</h1>
            <b class="mb-4" style="color:darkblue">ยินดีต้อนรับชุมชนเสื้อวินเทจ</b> 
            <br> <b class="mb-4" style="color:darkblue">ติดต่อได้ที่ Line ID : guygao12 หรือ FB : Sky Trakulto</b>
        </div>
    </div><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @forelse ($products as $item)
                        <div class="col-md-6">
                            <div class="blog-entry ftco-animate">
                                {{-- <a href="#" class="img img-2" style="background-image: url(/template/images/image_1.jpg);"></a> --}}
                                <img class="card-img-top" src="{{ asset($item->getProductAttachment[0]->path) }}" width="200" height="300" alt="Card image cap">
                                <div class="text text-2 pt-2 mt-3">
                                    <h3 class="mb-4"><a href="{{ route('website.detail', $item->product_id) }}">{{ $item->name }}</a></h3>
                                    <p class="mb-4">{{ $item->detail }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            {{-- <div class="blog-entry ftco-animate"> --}}
                                {{-- <div class="text text-2 pt-2 mt-3"> --}}
                                    <p class="mb-4" align="center">ไม่พบข้อมูล</p>
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    @endforelse
                </div><!-- END-->
            </div>
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box subs-wrap img" style="background-image: url(images/bg_1.jpg);">
                    <div class="overlay"></div>
                    <form action="#" class="subscribe-form">
                        <div class="form-group">
                            <h3 class="mb-4 sidebar-heading">ค้นหาชื่อเสื้อวง</h3>
                            <input type="text" name="name" value="{{ request()->input('name') ? request()->input('name') : null }}" class="form-control" placeholder="ค้นหาชื่อเสื้อวง"><br>
                            <h3 class="mb-4 sidebar-heading">ราคาเสื้อวงเริ่มต้น</h3>
                            <input type="text" name="priceStart" value="{{ request()->input('priceStart') ? request()->input('priceStart') : null }}" class="form-control" placeholder="ค้นหาราคาเสื้อวง"><br>
                            <h3 class="mb-4 sidebar-heading">ราคาเสื้อวงสิ้นสุด</h3>
                            <input type="text" name="priceEnd" value="{{ request()->input('priceEnd') ? request()->input('priceEnd') : null }}" class="form-control" placeholder="ค้นหาราคาเสื้อวง"><br>
                            <h3 class="mb-4 sidebar-heading">Categories</h3>
                            <select name="category_id" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($typeproducts as $item)
                                    <option {{ request()->input('category_id') == $item->type_product_id ? 'selected' : '' }} value="{{ $item->type_product_id }}">{{ $item->name }}</option>
                                @endforeach
                            </select><br>
                            <h3 class="mb-4 sidebar-heading">Size</h3>
                            <select name="size" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( request()->input('size') == 1 ? 'selected' : '')  }} value="1">S</option>
                                <option {{ ( request()->input('size') == 2 ? 'selected' : '')  }} value="2">M</option>
                                <option {{ ( request()->input('size') == 3 ? 'selected' : '')  }} value="3">L</option>
                                <option {{ ( request()->input('size') == 4 ? 'selected' : '')  }} value="4">XL</option>
                            </select><br>
                            <h3 class="mb-4 sidebar-heading">ชนิดผ้า</h3>
                            <select name="fabric_type" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( request()->input('fabric_type') == 1 ? 'selected' : '')  }} value="1">ผ้า Cotton 100%</option>
                                <option {{ ( request()->input('fabric_type') == 2 ? 'selected' : '')  }} value="2">ผ้า Cotton 50% Polyester 50%</option>
                            </select><br>
                            <h3 class="mb-4 sidebar-heading">ปีที่ผลิต</h3>
                            <select name="year" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( request()->input('year') == 1 ? 'selected' : '')  }} value="1">1980's</option>
                                <option {{ ( request()->input('year') == 2 ? 'selected' : '')  }} value="2">1990's</option>
                                <option {{ ( request()->input('year') == 3 ? 'selected' : '')  }} value="3">2000's</option>
                            </select><br>
                            <h3 class="mb-4 sidebar-heading">ประเทศที่ผลิต</h3>
                            <select name="made_in" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( request()->input('made_in') == 1 ? 'selected' : '')  }} value="1">U.S.A</option>
                                <option {{ ( request()->input('made_in') == 2 ? 'selected' : '')  }} value="2">Ecuador</option>
                                <option {{ ( request()->input('made_in') == 3 ? 'selected' : '')  }} value="3">Egypt</option>
                                <option {{ ( request()->input('made_in') == 4 ? 'selected' : '')  }} value="4">Other Europe</option>
                            </select><br>
                            <input type="submit" value="Subscribe" class="mt-2 btn btn-white submit">
                        </div>
                    </form>
	            </div>

	            {{-- <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">Categories</h3>
                    <ul class="categories">
                        @foreach ($typeproducts as $item)
                            <li><a href="{{ route('website.cat', $item->type_product_id) }}">{{ $item->name }}</a></li>
                        @endforeach
                        <li><a href="{{ route('website.home') }}">ดูทั้งหมด</a></li>
                    </ul>
	            </div> --}}

                {{-- <div class="sidebar-box ftco-animate">
                    <h3 class="sidebar-heading">Size</h3>
                    <ul class="tagcloud">
                        <a href="{{ route('website.size', "1") }}" class="tag-cloud-link">S</a>
                        <a href="{{ route('website.size', "2") }}" class="tag-cloud-link">M</a>
                        <a href="{{ route('website.size', "3") }}" class="tag-cloud-link">L</a>
                        <a href="{{ route('website.size', "4") }}" class="tag-cloud-link">XL</a>
                        <a href="{{ route('website.home') }}" class="tag-cloud-link">ดูทั้งหมด</a>
                    </ul>
                </div> --}}

                {{-- <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">ชนิดผ้า</h3>
                    <ul class="categories">
                        <li><a href="{{ route('website.fab', "1") }}">ผ้า Cotton 100%</a></li>
                        <li><a href="{{ route('website.fab', "2") }}">ผ้า Cotton 50% Polyester 50%</a></li>
                        <li><a href="{{ route('website.home') }}">ดูทั้งหมด</a></li>
                    </ul>
	            </div> --}}

                {{-- <div class="sidebar-box ftco-animate">
                    <h3 class="sidebar-heading">ปีที่ผลิต</h3>
                    <ul class="tagcloud">
                        <a href="{{ route('website.year', "1") }}" class="tag-cloud-link">1980</a>
                        <a href="{{ route('website.year', "2") }}" class="tag-cloud-link">1990</a>
                        <a href="{{ route('website.year', "3") }}" class="tag-cloud-link">2000</a>
                        <a href="{{ route('website.home') }}" class="tag-cloud-link">ดูทั้งหมด</a>
                    </ul>
                  </div> --}}

                {{-- <div class="sidebar-box ftco-animate">
	            	<h3 class="sidebar-heading">ประเทศที่ผลิต</h3>
                    <ul class="categories">
                        <li><a href="{{ route('website.madein', "1") }}">U.S.A</a></li>
                        <li><a href="{{ route('website.madein', "2") }}">Ecuador</a></li>
                        <li><a href="{{ route('website.madein', "3") }}">Egypt</a></li>
                        <li><a href="{{ route('website.madein', "4") }}">Other Europe</a></li>
                        <li><a href="{{ route('website.home') }}">ดูทั้งหมด</a></li>
                    </ul>
	            </div> --}}
            </div><!-- END COL -->
        </div>
    </div>
</section>
@endsection