@extends('template.master')
@section('content')
<div class="hero-wrap js-fullheight" style="background-image: url(/template/images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="js-fullheight d-flex justify-content-center align-items-center">
        <div class="col-md-8 text text-center">
            <div class="img mb-4" style="background-image: url(/templateimages/author.jpg);"></div>
            <div class="desc">
                {{-- <h2 class="subheading">Double T Vintage</h2> --}}
                <h1 class="mb-4">Double T Vintage</h1>
                {{-- <p class="mb-4">I am A Blogger Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                <p><a href="#" class="btn-custom">More About Me <span class="ion-ios-arrow-forward"></span></a></p> --}}
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-md-4">
                            <div class="blog-entry ftco-animate">
                                {{-- <a href="#" class="img img-2" style="background-image: url(/template/images/image_1.jpg);"></a> --}}
                                <img class="card-img-top" src="{{ asset($item->getProductAttachment[0]->path) }}" width="200" height="300" alt="Card image cap">
                                <div class="text text-2 pt-2 mt-3">
                                    <h3 class="mb-4"><a href="{{ route('website.detail', $item->product_id) }}">{{ $item->name }}</a></h3>
                                    <p class="mb-4">{{ $item->detail }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- END-->
            </div>

            {{-- <div class="col-lg-4 sidebar ftco-animate">
                <form action="" method="GET">
                    <div class="sidebar-box ftco-animate">
                        <h3 class="sidebar-heading">ประเภทสินค้า</h3>
                        <select name="" class="form-control">
                            <option value="">กรุณาเลือก</option>
                        </select>
                    </div>
                    <hr>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="sidebar-heading">ประเภทสินค้า</h3>
                        <select name="" class="form-control">
                            <option value="">กรุณาเลือก</option>
                        </select>
                    </div>
                </form>

            </div> --}}
        </div>
    </div>
</section>
@endsection