@extends('template.master')
@section('content')
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-6">
                <h2 class="h4 font-weight-bold">คอมเม้น</h2>
                <a href="{{ route('product.index') }}"><input type="button" value="ย้อนกลับ" class="btn btn-danger py-3 px-5"></a>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-12 order-md-last pr-md-6">
                <table id="alter" width="100%">  
                    <tr align="center">
                        <th>ลำดับ</th>
                        <th>ผู้ใช้</th>
                        <th>วันที่คอมเม้น</th>
                        <th>คอมเม้น</th>
                    </tr>  
                    @foreach ($dataComment as $key => $item)
                        <tr>
                            <td align="center">{{ $key + 1 }}</td>
                            <td align="center">{{ $item->getUser->name }}</td>
                            <td align="center">{{ $item->created_at }}</td>
                            <td align="center">{{ $item->comment }}</td>
                        </tr>  
                    @endforeach
                </table> 
            </div>
        </div>
    </div>
</section>
@endsection