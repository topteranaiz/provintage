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
        $priceStart = request()->input('priceStart');
        $priceEnd = request()->input('priceEnd');

        if (isset($inputs['name'])) {
            $product = $product->where('name','LIKE','%' . trim($inputs['name']) . '%');
        }

        if (!empty($priceStart)) {
            $product = $product->where('price', '>=', $priceStart);
        }

        if (!empty($priceEnd)) {
            $product = $product->where('price', '<=', $priceEnd);
        }

        if (!empty($priceStart) && !empty($priceEnd)) {
            $product = $product->whereBetween('price',array($priceStart, $priceEnd));
        }

        if (isset($inputs['category_id'])) {
            $product = $product->where('type_product_id', $inputs['category_id']);
        }

        if (isset($inputs['size'])) {
            $product = $product->where('size', $inputs['size']);
        }

        if (isset($inputs['fabric_type'])) {
            $product = $product->where('fabric_type', $inputs['fabric_type']);
        }

        if (isset($inputs['year'])) {
            $product = $product->where('year', $inputs['year']);
        }

        if (isset($inputs['made_in'])) {
            $product = $product->where('made_in', $inputs['made_in']);
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

        $inputs = request()->input();
        $this->data['blacklists'] = array();

        if (isset($inputs['type_cheat']) && !empty($inputs['type_cheat'])) {
            $this->data['blacklists'] = $blacklist->where('type_cheat',$inputs['type_cheat'])->get();
        }

        // $this->data['blacklists'] = $blacklist->get();
        $this->data['admin'] = $admin->first();

        return view('website.blacklist', $this->data);
    }

    public function detailBlacklist($id, Blacklist $blacklist, Admin $admin) {

        $this->data['dataBlacklists'] = $blacklist->find($id);
        return view('website.detailBlacklist', $this->data);
    }
}
