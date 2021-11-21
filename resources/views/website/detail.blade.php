@extends('template.master')
@section('content')
<section class="home-slider js-fullheight owl-carousel">
    @foreach ($detail->getProductAttachment as $item)
        <div class="slider-item js-fullheight" style="background-image:url({{ asset($item->path) }});">
            <div class="overlay"></div>
            <div class="container-fluid">
                <div class="row no-gutters slider-text slider-text-2 js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-10 text-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="blog-entry ftco-animate">
                            <div class="text pt-2 mt-3">
                                {{-- <span class="category mb-1 d-block"><a href="#">Technology</a></span> --}}
                                <h3 class="mb-4"><a href="#">{{ $detail->name }}</a></h3>
                                <p class="mb-4">{{ $detail->detail }}</p>
                                
                                <div class="meta-wrap d-md-flex align-items-center">
                                    <div class="half">
                                        <h3 class="mb-4"><a href="#">ข้อมูลผู้ขาย</a></h3>
                                        <p>ชื่อ : {{ $detail->getSaler->name }}</p>
                                        <p>E-mail : {{ $detail->getSaler->email }}</p>
                                        <p>Line : {{ $detail->getSaler->line_id }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="block comment">
                                    <h4>Comment</h4>
                                    
                                    @if(count($detail->getComment) > 0)
                                        @foreach ($detail->getComment as $item)
                                        {{-- {{ dd($item->getUser) }} --}}
                                            <div class="author mb-4 d-flex align-items-center">
                                                <a href="#" class="img" @if(!empty($item->getUser->image)) style="background-image: url({{ asset($item->getUser->image) }});" @else style="background-image: url(/image/default.png);" @endif></a>
                                                <div class="ml-3 info">
                                                    <span>{{ $item->comment }}</span>
                                                    <h3>{{ $item->getUser->name }}, <span>{{ $item->created_at }}</span></h3>
                                                </div>
                                            </div>
                                            {{-- <div class="media">
                                                <div class="media-body">
                                                    <div class="name">
                                                        <h5>{{ $item->getUser->name }}</h5>
                                                    </div>
                                                    <div class="date">
                                                        <p>{{ $item->created_at }}</p>
                                                    </div>
                                                    <div class="review-comment">
                                                        <p>{{ $item->comment }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr> --}}
                                        @endforeach
                                    @endif
                                    @if (!empty(Auth::guard('member')->user()))
                                        <form action="{{ route('website.shirt.comment') }}" method="POST">
                                            @csrf
                                            <div class="form-group mb-30">
                                                <input type="hidden" name="user_id" value="{{ Auth::guard('member')->user()->user_id  }}">
                                                <input type="hidden" name="product_id" value="{{ $detail->product_id }}">
                                                <label for="message">Message</label>
                                                <textarea class="form-control" id="message" name="comment" rows="8"></textarea>
                                            </div>
                                            <a><input type="submit" value="บันทึก" class="btn btn-success py-3 px-5"></a>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection