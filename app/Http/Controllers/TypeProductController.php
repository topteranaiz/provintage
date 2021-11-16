<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TypeProduct;
use Illuminate\Support\Facades\Auth;


class TypeProductController extends Controller
{

    public function index(TypeProduct $typeProduct) {
        $this->data['data'] = $typeProduct->get();
        return view('manage.typeproduct.index', $this->data);
    }

    public function create() {

        return view('manage.typeproduct.form');

    }

    public function store(Request $req, TypeProduct $typeProduct) {

        $inputs = $req->only('name');

        $typeProduct->create($inputs);

        return redirect('/type-product');
    }

    public function edit($id, TypeProduct $typeProduct) {

        $this->data['edit'] = $typeProduct->find($id);

        return view('manage.typeproduct.form', $this->data);
    }

    public function update(Request $req, TypeProduct $typeProduct) {

        $inputs = $req->only('name');
        $id = $req->type_product_id;

        $data = $typeProduct->find($id);

        $data->update($inputs);

        return redirect('/type-product');
    }

    public function delete($id, TypeProduct $typeProduct) {

        $data = $typeProduct->find($id);
        $data->delete();

        return redirect('/type-product');
    }
}
