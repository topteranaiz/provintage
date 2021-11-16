@extends('template.master')
@section('content')
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-6">
                <h2 class="h4 font-weight-bold">Blacklist</h2>
                {{-- <a href="{{ route('typeProduct.create') }}"><input type="button" value="เพิ่ม Blacklist" class="btn btn-success py-3 px-5"></a> --}}
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-12 order-md-last pr-md-6">
                <table id="alter" width="100%">  
                    <tr align="center">
                        <th>ลำดับ</th>
                        <th>ชื่อผู้ขาย</th>
                        <th>Action</th>
                    </tr>  
                    @foreach ($data as $key => $item)
                        <tr>
                            <td align="center">{{ $key + 1 }}</td>
                            <td align="center">{{ $item->name }}</td>
                            <td align="center">
                                <a href="{{ route('blacklist.edit',[$item->saler_id]) }}" style="color: rgb(116, 116, 114)">
                                    <i class="fa fa-save"></i> เพิ่ม Blacklist
                                </a>
                            </td>
                        </tr>  
                    @endforeach
                </table> 
            </div>
        </div>
    </div>
</section>
@endsection