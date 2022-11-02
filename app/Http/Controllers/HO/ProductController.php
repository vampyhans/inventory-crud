<?php

namespace App\Http\Controllers\HO;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function products()
    {
        $products = Product::all();
        return view('products.products', compact('products'));
    }

    public function add()
    {
        return view('products.add');
    }

    public function save(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:products',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'quantity' => 'required',

        ]);

        $products = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
        ]);

        if($products){
            Flasher::addSuccess('Product added successfully');
            return redirect()->route('products');
        }
        else{
            Flasher::addError('Something Went Wrong !');
            return redirect()->route('add-product');
        }
    }

    public function edit($id)
    {
        $product = Product::find(Crypt::decrypt($id));

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|unique:products',
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'quantity' => 'required',

        ]);

        $product = Product::find(Crypt::decrypt($id));
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->save();

        Flasher::addSuccess('Product updated successfully');
        return redirect()->route('products');
    }

    public function delete($id)
    {

        $product = Product::find(Crypt::decrypt($id));
        $product->delete();

        Flasher::addSuccess('Product updated successfully');
        return redirect()->route('products');
    }
}
