<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TypeProduct;
use App\Models\Saler;
use App\Models\Blacklist;

use Illuminate\Support\Facades\Auth;


class BlacklistController extends Controller
{

    public function index(Saler $saler) {
        $this->data['data'] = $saler->where('type_personal', 0)->get();
        return view('manage.blacklist.index', $this->data);
    }

    public function edit($id, Saler $saler) {

        $this->data['edit'] = $saler->find($id);

        return view('manage.blacklist.form', $this->data);
    }

    public function update(Request $req, Blacklist $blacklist) {

        $inputs = $req->only('detail', 'saler_id');
        if ($req->hasFile('image')) {
            foreach($req->file('image') as $key => $item){
                $filePath = 'image/blacklist';
                $this->createFolder($filePath);
                $ext = $item->getClientOriginalExtension();
                $size = \File::size($item);
                $oldFilename = $item->getClientOriginalName();
                $filename = $this->generateFilename(public_path($filePath));
                $filenameWithExtension = $filename . '.' . $ext;
                $attach['image'] = $filePath . '/' . $filenameWithExtension;
                $attach['detail'] = $inputs['detail'][$key];
                $attach['saler_id'] = $inputs['saler_id'];
                $blacklist->create($attach);
                //การบันทึกรูปตาม path
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
        }

        return redirect('/blacklist');
    }

    // public function delete($id, TypeProduct $typeProduct) {

    //     $data = $typeProduct->find($id);
    //     $data->delete();

    //     return redirect('/type-product');
    // }
}
