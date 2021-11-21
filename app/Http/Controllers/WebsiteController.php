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
use App\Models\Admin;


class WebsiteController extends Controller
{

    public function index(Product $product, TypeProduct $typeproduct) {

        $inputs = request()->input();

        if (isset($inputs['name'])) {
            $product = $product->where('name','LIKE','%' . trim($inputs['name']) . '%');
        }

        if (isset($inputs['price'])) {
            $product = $product->where('price',$inputs['price']);
        }

        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function searchCategories($searchCat, Product $product, TypeProduct $typeproduct) {

        if (isset($searchCat)) {
            $product = $product->where('type_product_id',$searchCat);
        }

        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function searchFabric($searchFab, Product $product, TypeProduct $typeproduct) {

        if (isset($searchFab)) {
            $product = $product->where('fabric_type',$searchFab);
        }

        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function searchSize($searchSize, Product $product, TypeProduct $typeproduct) {

        if (isset($searchSize)) {
            $product = $product->where('size',$searchSize);
        }

        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function searchYear($searchYear, Product $product, TypeProduct $typeproduct) {

        if (isset($searchYear)) {
            $product = $product->where('year',$searchYear);
        }

        $this->data['products'] = $product->get();
        $this->data['typeproducts'] = $typeproduct->get();
        return view('website.home', $this->data);
    }

    public function searchMadeIn($searchMadein, Product $product, TypeProduct $typeproduct) {

        if (isset($searchMadein)) {
            $product = $product->where('made_in',$searchMadein);
        }

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

    public function getBlacklist(Blacklist $blacklist, Admin $admin) {

        $this->data['blacklists'] = $blacklist->get();
        $this->data['admin'] = $admin->first();

        return view('website.blacklist', $this->data);
    }
}
