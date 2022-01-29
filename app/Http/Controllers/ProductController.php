<?php

namespace App\Http\Controllers;

use App\Product;
use App\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    // public function index(Request $request)
    // {
    //     $productInstance = new Product();
    //     $products = $productInstance->orderProducts($request->get('order_by'));
    //     return view('products.index', compact('products'));
    // }

    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->orderProducts($request->get('order_by'));

        if ($request->ajax()) {
            return response()->json($products, 200);
        }

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        // $review = Reviews::all();
        $review = Reviews::with('user')->get();
        $productRating = (int)Reviews::avg('rating');

        if ($product) {
            return view('products.show', compact('product', 'review', 'productRating'));
        } else {
            return redirect('/products')->with('errors', 'Produk tidak ditemukan');
        }
    }

    public function image($imageName)
    {
        $filePath = storage_path(env('PATH_IMAGE') . $imageName);
        return Image::make($filePath)->response();
    }

    public function storeReview(Request $request, $product_id)
    {
        $this->validate(request(), [
            'rating' => 'required|unique:products,name',
            'description' => 'required'
        ]);

        $review = new Reviews();
        $review->user_id = Auth::user()->id;
        $review->rating = $request->post('rating');
        $review->description = $request->post('description');
        $review->product_id = $product_id;

        $review->save();

        return redirect('products/' . $product_id);
    }

    public function getReview($product_id)
    {
    }
}
