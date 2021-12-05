@extends('template.master')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-6">
                    <h2 class="h4 font-weight-bold">Black List</h2>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12 order-md-last pr-md-6">
                    <form action="{{ isset($edit) ? route('blacklist.update') : route('blacklist.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($edit))
                            <input type="hidden" name="blacklist_id" value="{{ $edit->blacklist_id }}">
                        @endif
                        <div class="form-group">
                            <label>ชื่อ</label>
                            <input type="text" class="form-control" name="name" required value="{{ isset($edit) ? $edit->name: "" }}">
                        </div>
                        <div class="form-group">
                            <label>บัตรประชาชน</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="card_id" required value="{{ isset($edit) ? $edit->card_id: "" }}">
                        </div>
                        <div class="form-group">
                            <label>วันที่โอน</label>
                            <input type="date" class="form-control" name="date_transfer" required value="{{ isset($edit) ? $edit->date_transfer: "" }}">
                        </div>
                        <div class="form-group">
                            <label>ยอดโอน</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="price" required value="{{ isset($edit) ? $edit->price: "" }}">
                        </div>
                        <div class="form-group">
                            <label>เว็บประกาศขายของ</label>
                            <input type="text" class="form-control" name="web" required value="{{ isset($edit) ? $edit->web: "" }}">
                        </div>
                        <div class="form-group">
                            <label for="first-name">ประเภทการโกง</label>
                            <select name="type_cheat" class="form-control">
                                <option value="">กรุณาเลือก</option>
                                <option {{ ( isset($edit) && $edit->type_cheat == 1 ? 'selected' : '')  }} value="1">โอนแล้วไม่ส่งของ</option>
                                <option {{ ( isset($edit) && $edit->type_cheat == 2 ? 'selected' : '')  }} value="2">ส่งของไม่ตรงที่ซื้อ-ขาย</option>
                                <option {{ ( isset($edit) && $edit->type_cheat == 3 ? 'selected' : '')  }} value="3">สินค้าชำรุดแล้วไม่รับผิดชอบ</option>
                            </select>
                        </div>
                        <div id="dynamicfile">
                            <div class="form-group">
                                <label for="first-name">รูปภาพ BlackList</label>
                                <a type="button" id="add_file" class="badge badge-success badge-pill">+</a>
                                <input type="file" class="form-control" name="image[]" value="">
                            </div>
                        </div>

                        @if(isset($edit) && count($edit->getBlacklistImage) > 0)
                            @foreach ($edit->getBlacklistImage as $key => $item)
                                <div class="form-group">
                                    <label for="first-name">รูปภาพ {{$key+1}}</label>
                                    <a href="{{ route('blacklist.deleteImage',[$item->id]) }}" type="button">ลบรูปภาพ</a><br>
                                    <img src="{{ asset($item->image) }}" alt="" width="30%">
                                </div>
                            @endforeach
                        @endif

                        {{-- @if(isset($edit) && !empty($edit->image))
                            <div class="form-group">
                                <label for="first-name">รูปภาพ</label>
                                <img src="{{ asset($edit->image) }}" alt="" width="30%">
                            </div>
                        @endif --}}
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
                    '<label for="first-name">รูปภาพ BlackList</label>'+
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