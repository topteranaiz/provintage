@extends('template.master')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-6">
                    <h2 align="center" class="h4 font-weight-bold">แก้ไขโปรไฟล์ร้านค้า</h2>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12 order-md-last pr-md-6">
                    <form action="{{ route('profile.update.shop') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($edit))
                            <input type="hidden" name="saler_id" value="{{ $edit->saler_id }}">
                        @endif
                        <div class="form-group">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control" required placeholder="กรุณากรอก ชื่อ" value="{{ isset($edit) ? $edit->name: "" }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">อีเมล</label>
                            <input type="email" class="form-control" required placeholder="กรุณากรอก E-mail" value="{{ isset($edit) ? $edit->email: "" }}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">รหัสผ่าน</label>
                            <input type="password" class="form-control" placeholder="กรุณากรอก Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" required placeholder="กรุณากรอก ยืนยันรหัสผ่าน" name="confirmed">
                        </div>
                        <div class="form-group">
                            <label for="">รูปภาพโปรไฟล์</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        @if(isset($edit) && !empty($edit->image))
                            <div class="form-group">
                                <img src="{{ asset($edit->image) }}" alt="" width="30%">
                            </div>
                        @endif
                        <div class="shop form-group">
                            <label for="">Line</label>
                            <input type="text" class="form-control" value="{{ isset($edit) ? $edit->line_id: "" }}" name="line_id">
                        </div>
                        <div class="shop form-group">
                            <label for="">บัตรประชาชน</label>
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="กรุณากรอก บัตรประชาชน" value="{{ isset($edit) ? $edit->card_id: "" }}" name="card_id" maxlength="13">
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