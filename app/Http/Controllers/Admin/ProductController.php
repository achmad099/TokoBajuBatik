<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $products = Product::all();
        $products = Product::where('user_id', Auth::user()->id)->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'description' => 'required'
        ]);

        $file = $request->file('image_url');
        $ext = $file->getClientOriginalExtension();

        $dateTime = date('Ymd_his');
        $newName = 'image_' . $dateTime . '.' . $ext;

        $file->move(storage_path(env('PATH_IMAGE')), $newName);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->name = $request->post('name');
        $product->price = $request->post('price');
        $product->description = $request->post('description');
        $product->image_url = $newName;
        $product->save();

        return redirect('admin/products')->with('success', 'Produk berhasil di simpan');
    }

    public function show($id)
    {
        $detail = Product::where('id', $id)->get()->first();
        return view('admin.products.detail', compact('detail'));
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->get()->first();
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $product->name = $request->post('name');
        $product->price = $request->post('price');
        $product->description = $request->post('description');
        $product->save();

        return redirect('admin/products')->with('success', 'Produk berhasil di update');
    }

    public function destroy($id)
    {
        $products = Product::where('id', $id)->delete();
        return redirect('admin/products')->with('success', 'Produk berhasil di hapus');
    }

    public function viewImage($imageName)
    {
        $filePath = storage_path(env('PATH_IMAGE') . $imageName);
        return Image::make($filePath)->response();
    }
}
