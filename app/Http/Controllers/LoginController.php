<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\Saler;
use App\Models\Admin;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Auth;

class LoginController extends Controller
{

    public function index() {
        return view('home');
    }

    public function storeRegister(Request $req, Saler $saler, UserAccount $user, Admin $admin) {
        
        $inputs = $req->all();

        $dataSaler = $saler->where('email', $inputs['email'])->first();
        $dataUser = $user->where('email', $inputs['email'])->first();
        $dataAdmin = $admin->where('email', $inputs['email'])->first();


        if (!empty($dataSaler) || !empty($dataUser) || !empty($dataAdmin)) {
            return redirect()->back()->withInput()->with('error', 'E-mail นี้ถูกใช้ไปในระบบแล้ว'); 
        }

        
        if ($inputs['password'] != $inputs['confirmed']) {
            return redirect()->back()->withInput()->with('error', 'รหัสผ่านไม่ตรงกัน'); 
        }

        $inputs['password'] = Hash::make($req->password);

        if ($req->type_personal_id == 1) {

            if ($req->hasFile('image')) {
                $item = $req->file('image');
                $filePath = 'image/profile';
                $this->createFolder($filePath);
                $ext = $item->getClientOriginalExtension();
                $size = \File::size($item);
                $oldFilename = $item->getClientOriginalName();
                $filename = $this->generateFilename(public_path($filePath));
                $filenameWithExtension = $filename . '.' . $ext;
                $inputs['image'] = $filePath . '/' . $filenameWithExtension;
                // $data->update($attach);
                // $inputs['image'] = $attach['image'];
                $item->move(public_path($filePath) , $filenameWithExtension);
            }
            $saler->create($inputs);
        }else {
            if ($req->hasFile('image')) {
                $item = $req->file('image');
                $filePath = 'image/profile';
                $this->createFolder($filePath);
                $ext = $item->getClientOriginalExtension();
                $size = \File::size($item);
                $oldFilename = $item->getClientOriginalName();
                $filename = $this->generateFilename(public_path($filePath));
                $filenameWithExtension = $filename . '.' . $ext;
                $inputs['image'] = $filePath . '/' . $filenameWithExtension;
                // $data->update($attach);
                // $inputs['image'] = $attach['image'];
                $item->move(public_path($filePath) , $filenameWithExtension);
            }

            $user->create($inputs);
        }

        return redirect()->route('login');
    }

    public function postLogin(Request $req, Saler $saler, UserAccount $user, Admin $admin) {

        $typePersonal = $req->type_personal_id;
        $username = $req->email;
        $password = $req->password;

        $dataSaler = $saler->where('email', $username)->first();
        $dataUser = $user->where('email', $username)->first();
        $dataAdmin = $admin->where('email', $username)->first();


        if (empty($dataSaler) && empty($dataUser) && empty($dataAdmin)) {
            return redirect()->back()->with('error', 'ไม่สามารถเข้าสู่ระบบได้ เนื่องจากข้อมูลผิดพลาด'); 
        }


        if (!empty($dataSaler)) {

                if (!Hash::check($password, $dataSaler->password)) {
                    return redirect()->back()->withInput()->with('error', 'ไม่สามารถเข้าสู่ระบบได้ เนื่องจากรหัสผ่านไม่ถูกต้อง'); 

                }

                Auth::guard('shop')->attempt(['email' => $req->email, 'password' => $req->password]);
                session([
                    'data' => $dataSaler
                ]);
                // return redirect()->route('product.index');
                return redirect('/website');

            
        }else if(!empty($dataUser)) {

                if (!Hash::check($password, $dataUser->password)) {
                    return redirect()->back()->withInput()->with('error', 'ไม่สามารถเข้าสู่ระบบได้ เนื่องจากรหัสผ่านไม่ถูกต้อง'); 
                }

                Auth::guard('member')->attempt(['email' => $req->email, 'password' => $req->password]);
                session([
                    'data' => $dataUser
                ]);
                return redirect('/website');

        }else if(!empty($dataAdmin)) {
            if (!Hash::check($password, $dataAdmin->password)) {
                return redirect()->back()->withInput()->with('error', 'ไม่สามารถเข้าสู่ระบบได้ เนื่องจากรหัสผ่านไม่ถูกต้อง'); 
            }

            Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password]);
            session([
                'data' => $dataAdmin
            ]);
            return redirect('/website');
            // return redirect()->route('typeProduct.index');

        }
    }

    public function getLogout() {
        
        Session::flush();
        return redirect()->route('login');
    }
}
