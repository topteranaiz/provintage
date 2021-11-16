<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\TypeProduct;
use App\Models\Comment;
use App\Models\Blacklist;
use App\Models\UserAccount;
use App\Models\Saler;

class WebsiteController extends Controller
{

    public function index(Product $product, TypeProduct $typeproduct) {

        // dd(request()->all());
        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function detail($id, Product $product, Comment $comment) {

        $this->data['detail'] = $product->find($id);
        $this->data['dataComment'] = $comment->where('product_id', $id)->get();

        return view('website.detail', $this->data);
    }

    public function getDefine() {

        return view('website.define');
    }

    public function getShirtLabel() {

        return view('website.shirt_label');
    }

    public function storeComment(Request $req, Comment $comment) {

        $inputs = $req->all();
        $idDetail = $req->product_id;
        $inputs['created_at'] = Carbon::now();
        $comment->create($inputs);

        return redirect()->route('website.detail', [$idDetail]);

    }

    public function getBlacklist(Blacklist $blacklist, Saler $saler) {
        $dataBlacklist = $blacklist->get();

        $dataArray = array_column($dataBlacklist->toArray(), 'saler_id');

        $dataUnique = array_unique($dataArray);

        $this->data['salers'] = $saler->whereIn('saler_id', [$dataUnique])->get();

        return view('website.blacklist', $this->data);
    }
}
