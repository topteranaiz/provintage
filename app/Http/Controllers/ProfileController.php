<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\UserAccount;
use App\Models\Saler;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{

    public function editShop($id, Saler $saler) {

        $this->data['edit'] = $saler->find($id);

        return view('manage.profile.shop', $this->data);
    }

    public function editMember($id, UserAccount $user) {

        $this->data['edit'] = $user->find($id);

        return view('manage.profile.user', $this->data);
    }

    public function updateShop(Request $req, Saler $saler) {

        $inputs = $req->only('name', 'email', 'line_id', 'card_id');
        if (!empty($req->password)) {
            $inputs['password'] = Hash::make($req->password);
        }
        
        $id = $req->saler_id;

        $data = $saler->find($id);

        $data->update($inputs);

        if ($req->hasFile('image')) {
            $item = $req->file('image');
            $filePath = 'image/profile';
            $this->createFolder($filePath);
            $ext = $item->getClientOriginalExtension();
            $size = \File::size($item);
            $oldFilename = $item->getClientOriginalName();
            $filename = $this->generateFilename(public_path($filePath));
            $filenameWithExtension = $filename . '.' . $ext;
            $attach['image'] = $filePath . '/' . $filenameWithExtension;
            $data->update($attach);
            $item->move(public_path($filePath) , $filenameWithExtension);
        }

        return redirect()->route('profile.edit.shop', [$id]);
    }

    public function updateMember(Request $req, UserAccount $user) {

        $inputs = $req->only('name', 'email');
        if (!empty($req->password)) {
            $inputs['password'] = Hash::make($req->password);
        }
        
        $id = $req->user_id;

        $data = $user->find($id);

        $data->update($inputs);

        if ($req->hasFile('image')) {
            $item = $req->file('image');
            $filePath = 'image/profile';
            $this->createFolder($filePath);
            $ext = $item->getClientOriginalExtension();
            $size = \File::size($item);
            $oldFilename = $item->getClientOriginalName();
            $filename = $this->generateFilename(public_path($filePath));
            $filenameWithExtension = $filename . '.' . $ext;
            $attach['image'] = $filePath . '/' . $filenameWithExtension;
            $data->update($attach);
            $item->move(public_path($filePath) , $filenameWithExtension);
        }

        return redirect()->route('profile.edit.member', [$id]);
    }
}
