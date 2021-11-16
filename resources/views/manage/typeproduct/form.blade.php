@extends('template.master')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-6">
                    <h2 class="h4 font-weight-bold">เพิ่มประเภทสินค้า</h2>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12 order-md-last pr-md-6">
                    <form action="{{ isset($edit) ? route('typeProduct.update') : route('typeProduct.store') }}" method="POST">
                        @csrf
                        @if(isset($edit))
                            <input type="hidden" name="type_product_id" value="{{$edit->type_product_id}}">
                        @endif
                        <div class="form-group">
                            <input type="text" class="form-control" required name="name" value="{{ isset($edit) ? $edit->name: "" }}" placeholder="กรุณากรอก ชื่อประเภทสินค้า">
                        </div>
                        <div align="center" class="form-group">
                            <input type="submit" value="บันทึก" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
