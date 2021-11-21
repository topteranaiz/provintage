{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('template.master')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="col-md-12 mb-6">
                    <h2 align="center" class="h4 font-weight-bold">Register</h2>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-12 order-md-last pr-md-6">
                    <form action="{{ route('store.register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>{!! \Session::get('error') !!}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">กรุณาเลือกประเภท</label>
                            <select name="type_personal_id" class="typePersonal form-control">
                                <option value="">กรุณาเลือกประเภท</option>
                                <option {{ old('type_personal_id') == "1" ? 'selected': '' }} value="1">พ่อค้าแม่ค้า</option>
                                <option {{ old('type_personal_id') == "2" ? 'selected': '' }} value="2">สมาชิก</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">ชื่อ</label>
                            <input type="text" class="form-control" required placeholder="กรุณากรอก ชื่อ" value="{{ old('name') }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="">อีเมล</label>
                            <input type="email" class="form-control" required placeholder="กรุณากรอก E-mail" value="{{ old('email') }}" name="email">
                        </div>
                        <div class="form-group">
                            <label for="">รหัสผ่าน</label>
                            <input type="password" class="form-control" required placeholder="กรุณากรอก Password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="">ยืนยันรหัสผ่าน</label>
                            <input type="password" class="form-control" required placeholder="กรุณากรอก ยืนยันรหัสผ่าน" name="confirmed">
                        </div>
                        <div class="form-group">
                            <label for="">รูปภาพโปรไฟล์</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="shop form-group" @if(old('type_personal_id') == "1") style="display: block;" @else style="display: none;"@endif>
                            <label for="">Line</label>
                            <input type="text" class="form-control" placeholder="กรุณากรอก Line" name="line_id" value="{{ old('line_id') }}">
                        </div>
                        <div class="shop form-group" @if(old('type_personal_id') == "1") style="display: block;" @else style="display: none;"@endif>
                            <label for="">บัตรประชาชน</label>
                            <input type="text" class="form-control" placeholder="กรุณากรอก บัตรประชาชน" name="card_id" maxlength="13" value="{{ old('card_id') }}">
                        </div>
                        <div align="center" class="form-group">
                            <input type="submit" value="Register" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('.typePersonal').change(function() {
            var data = $(this).val();
            if (data == 1) {
                $('.shop').show();
            }else {
                $('.shop').hide();
            }
            console.log('data', data)
        });
    </script>
@endsection