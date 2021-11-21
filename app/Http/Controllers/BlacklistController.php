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

    public function index(Blacklist $blacklist) {
        $this->data['data'] = $blacklist->get();
        return view('manage.blacklist.index', $this->data);
    }

    public function create() {

        return view('manage.blacklist.form');
    }

    public function store(Request $req, Blacklist $blacklist) {

        $inputs = $req->only('name', 'card_id', 'price', 'date_transfer', 'web');
        $newObj = $blacklist->create($inputs);

        if ($req->hasFile('image')) {
            $data = $blacklist->find($newObj->blacklist_id);
            $item = $req->file('image');
            $filePath = 'image/blacklist';
            $this->createFolder($filePath);
            $ext = $item->getClientOriginalExtension();
            $size = \File::size($item);
            $oldFilename = $item->getClientOriginalName();
            $filename = $this->generateFilename(public_path($filePath));
            $filenameWithExtension = $filename . '.' . $ext;
            $attach['image'] = $filePath . '/' . $filenameWithExtension;
            $data->update($attach);
            //การบันทึกรูปตาม path
            $item->move(public_path($filePath) , $filenameWithExtension);
        }

        return redirect('/blacklist');
    }

    public function edit($id, Blacklist $blacklist) {

        $this->data['edit'] = $blacklist->find($id);

        return view('manage.blacklist.form', $this->data);
    }
    

    public function update(Request $req, Blacklist $blacklist) {

        $inputs = $req->only('name', 'card_id', 'price', 'date_transfer', 'web');

        $id = $req->blacklist_id;

        $dataBlacklist = $blacklist->find($id);

        $dataBlacklist->update($inputs);

        if ($req->hasFile('image')) {
            $item = $req->file('image');
            $filePath = 'image/blacklist';
            $this->createFolder($filePath);
            $ext = $item->getClientOriginalExtension();
            $size = \File::size($item);
            $oldFilename = $item->getClientOriginalName();
            $filename = $this->generateFilename(public_path($filePath));
            $filenameWithExtension = $filename . '.' . $ext;
            $attach['image'] = $filePath . '/' . $filenameWithExtension;
            $dataBlacklist->update($attach);
            //การบันทึกรูปตาม path
            $item->move(public_path($filePath) , $filenameWithExtension);
        }

        return redirect('/blacklist');
    }

    public function delete($id, Blacklist $blacklist) {

        $data = $blacklist->find($id);
        if (!empty($data->image)) {
            if(file_exists($data->path)){
                //ทำการลบรูปภาพในเครื่อง
                unlink(public_path($data->path));
            }
        }
        $data->delete();

        return redirect('/blacklist');
    }
}
