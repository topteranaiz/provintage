<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Comment;
use App\Models\ProductAttachment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            //ดึงข้อมูลคนที่ login
            $this->shop = session()->get('data');
            return $next($request);
        });
    }

    //หน้ารายการสินค้า
    public function index(Product $product) {

        $this->data['dataProducts'] = $product->where('saler_id', $this->shop->saler_id)->get();
        return view('manage.product.index', $this->data);
    }
    //หน้าสร้างสินค้า
    public function create(TypeProduct $typeProduct) {

        $this->data['dataTypeProducts'] = $typeProduct->get();
        return view('manage.product.form', $this->data);
    }

    //การบันทึกข้อมูลลงฐานข้อมูล
    public function store(Request $req, Product $product, ProductAttachment $attachment) {

        $inputs = $req->only('type_product_id', 'fabric_type', 'size', 'name', 'amount', 'detail', 'price', 'year', 'made_in');

        // dd($this->shop);
        $inputs['saler_id'] = $this->shop->saler_id;
        $inputs['created_at'] = Carbon::now();

        $newObj = $product->create($inputs);

        //การบันทึกรูปภาพลงเครื่อง
        if ($req->hasFile('image')) {
            foreach($req->file('image') as $key => $item){
                $filePath = 'image/product';
                $this->createFolder($filePath);
                $ext = $item->getClientOriginalExtension();
                $size = \File::size($item);
                $oldFilename = $item->getClientOriginalName();
                $filename = $this->generateFilename(public_path($filePath));
                $filenameWithExtension = $filename . '.' . $ext;
                $attach['filename'] = $filename;
                $attach['path'] = $filePath . '/' . $filenameWithExtension;
                $attach['product_id'] = $newObj->product_id;
                $attachment->create($attach);
                //การบันทึกรูปตาม path
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
        }

        return redirect('/product');
    }

    //การแก้ไขข้อมูล
    public function edit($id, Product $product, TypeProduct $typeProduct) {

        $this->data['dataTypeProducts'] = $typeProduct->get();
        $this->data['edit'] = $product->find($id);
        return view('manage.product.form', $this->data);

    }

    //การอัปเดตข้อมูลที่จะทำการแก้ไข
    public function update(Request $req, Product $product, ProductAttachment $attachment) {

        $inputs = $req->only('type_product_id', 'fabric_type', 'size', 'name', 'amount', 'detail', 'price', 'year', 'made_in');
        $id = $req->product_id;

        $dataProduct = $product->find($id);

        $inputs['updated_at'] = Carbon::now();

        $dataProduct->update($inputs);

        //การบันทึกรูปภาพลงเครื่อง
        if ($req->hasFile('image')) {
            foreach($req->file('image') as $key => $item){
                $filePath = 'image/product';
                $this->createFolder($filePath);
                $ext = $item->getClientOriginalExtension();
                $size = \File::size($item);
                $oldFilename = $item->getClientOriginalName();
                $filename = $this->generateFilename(public_path($filePath));
                $filenameWithExtension = $filename . '.' . $ext;
                $attach['filename'] = $filename;
                $attach['path'] = $filePath . '/' . $filenameWithExtension;
                $attach['product_id'] = $id;
                $attachment->create($attach);
                //การบันทึกรูปตาม path
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
        }

        return redirect('/product');
    }

    //ทำการลบรูปภาพ
    public function deleteImage($id, ProductAttachment $attachment) {

        $data = $attachment->find($id);
        $product_id = $data->product_id;
        if ($data) {
            if(file_exists($data->path)){
                //ทำการลบรูปภาพในเครื่อง
                unlink(public_path($data->path));
                //ลบข้อมูลออกจากฐ้านข้อมูล
                $data->delete();
            }
            return redirect()->route('product.edit', [$product_id]);
        }
    }

    //ลบรูปข้อมูล
    public function delete($id, Product $product) {

        if ($id) {
            $data = $product->find($id);
            if ($data->getProductAttachment->count() > 0) {
                foreach($data->getProductAttachment as $item) {
                    if (!empty($item->path)) {
                        if(file_exists($item->path)){
                            //ทำการลบรูปภาพในเครื่อง
                            unlink(public_path($item->path));
                        }
                    }
                    //ลบข้อมูลออกจากฐ้านข้อมูล
                    $item->delete();
                }
            }
            $data->delete();
        }

        return redirect('/product');
    }

    //รายการที่ลูกค้าคอมเม้น
    public function getComment($id, Comment $comment) {

        $this->data['dataComment'] = $comment->where('product_id', $id)->get();

        return view('manage.product.comment', $this->data);
    }
}
