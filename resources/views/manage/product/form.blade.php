@extends('template.master')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-6">
                    <h2 class="h4 font-weight-bold">เพิ่มสินค้า</h2>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12 order-md-last pr-md-6">
                    <form action="{{ isset($edit) ? route('product.update') : route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($edit))
                            <input type="hidden" name="product_id" value="{{$edit->product_id}}">
                        @endif
                        <div class="form-group">
                            <label for="first-name">ประเภทสินค้า</label>
                            <select name="type_product_id" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                @foreach ($dataTypeProducts as $item)
                                    <option {{ isset($edit) && $edit->type_product_id == $item->type_product_id ? 'selected' : '' }} value="{{ $item->type_product_id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name">ชนิดผ้า</label>
                            <select name="fabric_type" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( isset($edit) && $edit->fabric_type == 1 ? 'selected' : '')  }} value="1">ผ้า Cotton 100%</option>
                                <option {{ ( isset($edit) && $edit->fabric_type == 2 ? 'selected' : '')  }} value="2">ผ้า Cotton 50% Polyester 50%</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="name" value="{{ isset($edit) ? $edit->name: "" }}">
                        </div>
                        <div class="form-group">
                            <label for="first-name">รายละเอียดสินค้า</label>
                            <textarea type="text" class="form-control" name="detail" rows="10" cols="30">{{ isset($edit) ? $edit->detail: ""  }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="first-name">ขนาด</label>
                            <select name="size" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( isset($edit) && $edit->size == 1 ? 'selected' : '')  }} value="1">S</option>
                                <option {{ ( isset($edit) && $edit->size == 2 ? 'selected' : '')  }} value="2">M</option>
                                <option {{ ( isset($edit) && $edit->size == 3 ? 'selected' : '')  }} value="3">L</option>
                                <option {{ ( isset($edit) && $edit->size == 4 ? 'selected' : '')  }} value="4">XL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name">จำนวน</label>
                            <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="amount" value="{{ isset($edit) ? $edit->amount: "" }}">
                        </div>
                        <div class="form-group">
                            <label for="first-name">ราคา</label>
                            <input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="price" value="{{ isset($edit) ? $edit->price: "" }}">
                        </div>
                        <div class="form-group">
                            <label for="first-name">ปีที่ผลิต</label>
                            <select name="year" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( isset($edit) && $edit->year == 1 ? 'selected' : '')  }} value="1">1980's</option>
                                <option {{ ( isset($edit) && $edit->year == 2 ? 'selected' : '')  }} value="2">1990's</option>
                                <option {{ ( isset($edit) && $edit->year == 3 ? 'selected' : '')  }} value="3">2000's</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="first-name">ป้ายคอเสื้อ</label>
                            <select name="made_in" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( isset($edit) && $edit->made_in == 1 ? 'selected' : '')  }} value="1">U.S.A</option>
                                <option {{ ( isset($edit) && $edit->made_in == 2 ? 'selected' : '')  }} value="2">Ecuador</option>
                                <option {{ ( isset($edit) && $edit->made_in == 3 ? 'selected' : '')  }} value="3">Egypt</option>
                                <option {{ ( isset($edit) && $edit->made_in == 4 ? 'selected' : '')  }} value="4">Other Europe</option>
                            </select>
                        </div>

                        <div id="dynamicfile">
                            <div class="form-group">
                                <label for="first-name">รูปภาพ</label>
                                <a type="button" id="add_file" class="badge badge-success badge-pill">+</a>
                                <input type="file" class="form-control" multiple name="image[]" value="">
                            </div>
                        </div>
                        @if(isset($edit) && count($edit->getProductAttachment) > 0)
                            @foreach ($edit->getProductAttachment as $key => $item)
                                <div class="form-group">
                                    <label for="first-name">รูปภาพ {{$key+1}}</label>
                                    <a href="{{ route('product.deleteImage',[$item->id]) }}" type="button">ลบรูปภาพ</a><br>
                                    <img src="{{ asset($item->path) }}" alt="" width="30%">
                                </div>
                            @endforeach
                        @endif
                        <div align="center" class="form-group">
                            <input type="submit" value="บันทึก" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
    $(document).ready(function () {
        var i = 1;
        $('#add_file').click(function() {
            i++;
            var fields =
                '<div id="row'+i+'" class="form-group">'+
                    '<label for="first-name">รูปภาพ</label>'+
                        '<a type="button" id="'+i+'" class="badge badge-danger badge-pill removeFile">-</a>'+
                        '<input type="file" class="form-control" multiple name="image[]" value="">'+
                '</div>';

            $('#dynamicfile').append(fields);
            $(document).on('click', '.removeFile', function() {

                var button_id = $(this).attr("id");

                $('#row'+button_id+'').remove();
            });
        });
    });

</script>
@endsection