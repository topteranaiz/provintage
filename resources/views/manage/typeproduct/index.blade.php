@extends('template.master')
@section('content')
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex mb-5 contact-info">
            <div class="col-md-12 mb-6">
                <h2 class="h4 font-weight-bold">ประเภทสินค้า</h2>
                <a href="{{ route('typeProduct.create') }}"><input type="button" value="เพิ่มประเภทสินค้า" class="btn btn-success py-3 px-5"></a>
            </div>
        </div>
        <div class="row block-9">
            <div class="col-md-12 order-md-last pr-md-6">
                <table id="alter" width="100%">  
                    <tr align="center">
                        <th>ลำดับ</th>
                        <th>ชื่อประเภทสินค้า</th>
                        <th>Action</th>
                    </tr>  
                    @foreach ($data as $key => $item)
                        <tr>
                            <td align="center">{{ $key + 1 }}</td>
                            <td align="center">{{ $item->name }}</td>
                            <td align="center">
                                <a href="{{ route('typeProduct.edit',[$item->type_product_id]) }}" style="color: rgb(116, 116, 114)">
                                    <i class="fa fa-save"></i> แก้ไข
                                </a>
                                <a onclick="alertConfirm({{ $item->type_product_id }})" style="color: red">
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
                    window.location.href = "{{URL::to('type-product/delete')}}"+'/'+id
                }
            })
            console.log('id', id)
        }
    </script>
@endsection