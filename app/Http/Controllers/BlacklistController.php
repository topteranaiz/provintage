<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TypeProduct;
use App\Models\Saler;
use App\Models\Blacklist;
use App\Models\BlacklistImage;


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

    public function store(Request $req, Blacklist $blacklist, BlacklistImage $blacklistImage) {

        $inputs = $req->only('name', 'card_id', 'price', 'date_transfer', 'web', 'type_cheat');
        $newObj = $blacklist->create($inputs);

        // if ($req->hasFile('image')) {
        //     $data = $blacklist->find($newObj->blacklist_id);
        //     $item = $req->file('image');
        //     $filePath = 'image/blacklist';
        //     $this->createFolder($filePath);
        //     $ext = $item->getClientOriginalExtension();
        //     $size = \File::size($item);
        //     $oldFilename = $item->getClientOriginalName();
        //     $filename = $this->generateFilename(public_path($filePath));
        //     $filenameWithExtension = $filename . '.' . $ext;
        //     $attach['image'] = $filePath . '/' . $filenameWithExtension;
        //     $data->update($attach);
        //     //การบันทึกรูปตาม path
        //     $item->move(public_path($filePath) , $filenameWithExtension);
        // }

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
                $attach['blacklist_id'] = $newObj->blacklist_id;
                $blacklistImage->create($attach);
                //การบันทึกรูปตาม path
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
        }

        return redirect('/website/blacklist');
    }

    public function edit($id, Blacklist $blacklist) {

        $this->data['edit'] = $blacklist->find($id);

        return view('manage.blacklist.form', $this->data);
    }
    

    public function update(Request $req, Blacklist $blacklist, BlacklistImage $blacklistImage) {

        $inputs = $req->only('name', 'card_id', 'price', 'date_transfer', 'web', 'type_cheat');

        $id = $req->blacklist_id;

        $dataBlacklist = $blacklist->find($id);

        $dataBlacklist->update($inputs);

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
                $attach['blacklist_id'] = $dataBlacklist->blacklist_id;
                $blacklistImage->create($attach);
                //การบันทึกรูปตาม path
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
        }

        // if ($req->hasFile('image')) {
        //     $item = $req->file('image');
        //     $filePath = 'image/blacklist';
        //     $this->createFolder($filePath);
        //     $ext = $item->getClientOriginalExtension();
        //     $size = \File::size($item);
        //     $oldFilename = $item->getClientOriginalName();
        //     $filename = $this->generateFilename(public_path($filePath));
        //     $filenameWithExtension = $filename . '.' . $ext;
        //     $attach['image'] = $filePath . '/' . $filenameWithExtension;
        //     $dataBlacklist->update($attach);
        //     //การบันทึกรูปตาม path
        //     $item->move(public_path($filePath) , $filenameWithExtension);
        // }

        return redirect('/website/blacklist');
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

        return redirect('/website/blacklist');
    }

    public function deleteImage($id, BlacklistImage $blacklistImage) {

        $data = $blacklistImage->find($id);
        $blacklist_id = $data->blacklist_id;
        if ($data) {
            if(file_exists($data->image)){
                //ทำการลบรูปภาพในเครื่อง
                unlink(public_path($data->image));
                //ลบข้อมูลออกจากฐ้านข้อมูล
                $data->delete();
            }
            return redirect()->route('blacklist.edit', [$blacklist_id]);
        }
    }
}
