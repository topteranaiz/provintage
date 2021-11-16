<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAccount;
use App\Models\Saler;
use Illuminate\Http\Request;
use Redirect;
use Session;
use Auth;

class LoginController extends Controller
{

    public function index() {
        return view('home');
    }

    public function storeRegister(Request $req, Saler $saler, UserAccount $user) {
        
        $inputs = $req->all();
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

    public function postLogin(Request $req, Saler $saler, UserAccount $user) {

        $typePersonal = $req->type_personal_id;
        $username = $req->email;
        $password = $req->password;

        if ($typePersonal == 1) {
            $data = $saler->where('email', $username)->first();

            if (!empty($data)) {
                if (!Hash::check($password, $data->password)) {
                    return Redirect::back()
                        ->with('warning')
                        ->withInput();
                }

                Auth::guard('shop')->attempt(['email' => $req->email, 'password' => $req->password]);

                session([
                    'data' => $data
                ]);

                return redirect()->route('typeProduct.index');

            } else {
                return Redirect::back()
                    ->with('warning')
                    ->withInput();
            }
            
        }else {
            $data = $user->where('email', $username)->first();

            if (!empty($data)) {
                if (!Hash::check($password, $data->password)) {
                    return Redirect::back()
                        ->with('warning')
                        ->withInput();
                }

                Auth::guard('member')->attempt(['email' => $req->email, 'password' => $req->password]);

                session([
                    'data' => $data
                ]);

                return redirect('/website');

            } else {
                return Redirect::back()
                    ->with('warning')
                    ->withInput();
            }

        }

    }

    public function getLogout() {
        
        Session::flush();
        return redirect()->route('login');
    }
}
