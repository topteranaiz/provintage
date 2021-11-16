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
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <label style="color: red">(ไม่สามารถแก้ไขได้)</label>
                        <input type="text" class="form-control" readonly value="{{ isset($edit) ? $edit->name: "" }}">
                    </div>
                    <div class="form-group">
                        <label>อีเมล</label>
                        <label style="color: red">(ไม่สามารถแก้ไขได้)</label>
                        <input type="text" class="form-control" readonly value="{{ isset($edit) ? $edit->email: "" }}">
                    </div>
                    <div class="form-group">
                        <label>บัตรประชาชน</label>
                        <label style="color: red">(ไม่สามารถแก้ไขได้)</label>
                        <input type="text" class="form-control" readonly value="{{ isset($edit) ? $edit->card_id: "" }}">
                    </div>
                    <div class="form-group">
                        <label>Line</label>
                        <label style="color: red">(ไม่สามารถแก้ไขได้)</label>
                        <input type="text" class="form-control" readonly value="{{ isset($edit) ? $edit->line_id: "" }}">
                    </div>
                    @if(isset($edit) && !empty($edit->image))
                        <div class="form-group">
                            <label for="first-name">รูปภาพ</label>
                            <img src="{{ asset($edit->image) }}" alt="" width="30%">
                        </div>
                    @endif
                    @if(isset($edit) && count($edit->getBlacklist) > 0)
                        @foreach ($edit->getBlacklist as $item)
                            <div class="form-group">
                                <label for="first-name">รูปภาพ</label>
                                <img src="{{ asset($item->image) }}" alt="" width="50%">
                            </div>
                            <div class="form-group">
                                <label for="first-name">แหล่งอ้างอิง: </label>
                                <label>{{ $item->detail }}</label>
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('blacklist.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($edit))
                            <input type="hidden" name="saler_id" value="{{ $edit->saler_id }}">
                        @endif
                        <div id="dynamicfile">
                            <div class="form-group">
                                <label for="first-name">รูปภาพ BlackList</label>
                                <a type="button" id="add_file" class="badge badge-success badge-pill">+</a>
                                <input type="file" class="form-control" name="image[]" value="">
                            </div>
                            <div class="form-group">
                                <label for="first-name">แหล่งอ้างอิง</label>
                                <input type="text" class="form-control" name="detail[]" value="">
                            </div>
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
                '</div>'+
                '<div class="form-group">'+
                    '<label for="first-name">แหล่งอ้างอิง</label>'+
                    '<input type="text" class="form-control" name="detail[]" value="">'+
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