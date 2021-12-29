@extends('template.master')
@section('content')
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-6">
                <h2 class="h4 font-weight-bold">รายการสินค้า</h2>
                <a href="{{ route('product.create') }}"><input type="button" value="เพิ่มรายการสินค้า" class="btn btn-success py-3 px-5"></a>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-12 order-md-last pr-md-6">
                <table id="alter" width="100%">  
                    <tr align="center">
                        <th>ลำดับ</th>
                        <th>ชื่อประเภทสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                        <th>Action</th>
                    </tr>  
                    @foreach ($dataProducts as $key => $item)
                        <tr>
                            <td align="center">{{ $key + 1 }}</td>
                            <td align="center">{{ !empty($item->getTypeProduct) && !empty($item->getTypeProduct->name) ? $item->getTypeProduct->name: '-' }}</td>
                            <td align="center">{{ $item->name }}</td>
                            <td align="center">{{ $item->price }}</td>
                            <td align="center">{{ $item->amount }}</td>
                            <td align="center">
                                <a href="{{ route('product.comment',[$item->product_id]) }}" style="color: rgb(31, 19, 185)">
                                    <i class="fa fa-home"></i>คอมเม้น
                                </a>
                                <a href="{{ route('product.edit',[$item->product_id]) }}" style="color: rgb(116, 116, 114)">
                                    <i class="fa fa-save"></i> แก้ไข
                                </a>
                                <a onclick="alertConfirm({{ $item->product_id }})" style="color: red">
                                    <i class="fa fa-trash"></i> ลบ
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@section('js')
    <script>
        function alertConfirm(id) {
            Swal.fire({
            title: 'ยืนยันการลบข้อมูล?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{URL::to('product/delete')}}"+'/'+id
                }
            })
            console.log('id', id)
        }
    </script>
@endsection