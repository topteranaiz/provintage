@extends('template.master')
@section('content')
<section class="ftco-section">
    <h4 align="center">BlackList</h4>
    <p align="center">แจ้งรายงานแอดมินได้ที่</p>
    <p align="center">Line : {{ $admin->line_id }}</p>
    <p align="center">Facebook : {{ $admin->facebook }}</p>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @foreach ($blacklists as $item)
                        <div class="col-md-4">
                            <div class="blog-entry ftco-animate">
                                <img class="card-img-top" @if(!empty($item->image)) src="{{ asset($item->image) }}" @else src="/image/default.png" @endif width="200" height="300" alt="Card image cap">
                                <div class="text text-2 pt-2 mt-3">
                                    <h3 align="center" class="mb-4"><a href="#">ชื่อ: {{ $item->name }}</a></h3>
                                    <p>รหัสบัตรประชาชน: {{ $item->card_id }}</p>
                                    <p>วันที่โอน: {{ $item->date_transfer }}</p>
                                    <p>ยอดโอน: {{ $item->price }}</p>
                                    <p>เว็บประกาศขายของ: {{ $item->web }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- END-->
            </div>
        </div>
    </div>
</section>
@endsection