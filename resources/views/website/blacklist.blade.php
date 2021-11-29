@extends('template.master')
@section('content')
<section class="ftco-section">
    @if(!empty(Auth::guard('admin')->user()))
        <a href="{{ route('blacklist.create') }}"><h4 align="center">เพิ่ม BlackList</h4></a>
    @endif
    <h3 align="center">BlackList</h3>
    <p align="center">แจ้งรายงานแอดมินได้ที่</p>
    <p align="center">Line : {{ $admin->line_id }}</p>
    <p align="center">Facebook : {{ $admin->facebook }}</p>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @foreach ($blacklists as $item)
                        <div class="col-md-6">
                            <div class="blog-entry ftco-animate">
                                <img class="card-img-top" @if(count($item->getBlacklistImage) > 0) src="{{ asset($item->getBlacklistImage[0]->image) }}" @else src="/image/default.png" @endif width="200" height="300" alt="Card image cap">
                                <div class="text text-2 pt-2 mt-3">
                                    <h3 align="center" class="mb-4"><a href="#">ชื่อ: {{ $item->name }}</a></h3>
                                    <p>รหัสบัตรประชาชน: {{ $item->card_id }}</p>
                                    <p>วันที่โอน: {{ $item->date_transfer }}</p>
                                    <p>ยอดโอน: {{ $item->price }} บาท</p>
                                    <p>เว็บประกาศขายของ: {{ $item->web }}</p>
                                    @if(!empty(Auth::guard('admin')->user()))
                                        <a href="{{ route('blacklist.edit',[$item->blacklist_id]) }}" style="color: rgb(116, 116, 114)">
                                            <i class="fa fa-save"></i> แก้ไข
                                        </a>
                                        <a href="{{ route('blacklist.delete',[$item->blacklist_id]) }}" style="color: red">
                                            <i class="fa fa-trash"></i> ลบ
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- END-->
            </div>
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box subs-wrap img" style="background-image: url(images/bg_1.jpg);">
                    <div class="overlay"></div>
                    <form action="#" class="subscribe-form">
                        <div class="form-group">
                            <h3 class="mb-4 sidebar-heading">ค้นหาประเภทการโกง</h3>
                            <select name="type_cheat" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ request()->input('type_cheat') == "1" ? 'selected' : '' }} value="1">โอนแล้วไม่ส่งของ</option>
                                <option {{ request()->input('type_cheat') == "2" ? 'selected' : '' }} value="2">ส่งของไม่ตรงที่ซื้อ-ขาย</option>
                                <option {{ request()->input('type_cheat') == "3" ? 'selected' : '' }} value="3">สินค้าชำรุดแล้วไม่รับผิดชอบ</option>
                            </select>
                            <input type="submit" value="ค้นหา" class="mt-2 btn btn-white submit">
                        </div>
                    </form>
	            </div>
            </div><!-- END COL -->
        </div>
    </div>
</section>
@endsection