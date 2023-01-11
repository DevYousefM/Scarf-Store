<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view("admin.all_products", ["products" => Product::all()]);
    }

    public function create()
    {
        return view("admin.product");
    }

    public function store(Request $request)
    {

        $request->validate([
            'product_title' => 'required|string',
            'product_desc' => 'required',
            'product_price' => 'required|integer',
            'product_discount' => 'required|integer',
            'product_image' => 'required',
        ]);
        $path = $request->file('product_image')->store('products_imgs', "public");
        Product::create([
            "title" => $request->product_title,
            "description" => $request->product_desc,
            "image" => $path,
            "price" => $request->product_price,
            "discount" => $request->product_discount,
        ]);
        return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show($id)
    {
        $product  = Product::findOrFail($id);
        return view("admin.product_page", ["product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_title' => 'required|string',
            'product_desc' => 'required|string',
            'product_price' => 'required|integer',
            'product_discount' => 'required|integer',
        ]);
        Product::where("id", $id)->update([
            "title" => $request->product_title,
            "description" => $request->product_desc,
            "price" => $request->product_price,
            "discount" => $request->product_discount,
        ]);
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function delProd($id)
    {
        $product = Product::findOrFail($id);

        if (
            $product->delete()
        ) {

            Storage::disk("public")->delete($product->image);
        }


        return redirect()->route("adProd.index")->with('message', 'Product Deleted Successfully');
    }
}
