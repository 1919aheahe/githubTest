<?php

namespace App\Http\Controllers;

use App\Product;
use App\Company;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $companies = Company::all();

        // 検索フォーム
        $keyword = $request->input('keyword');
        $company_id = $request->input('company_id');

        $query = Product::query();


        if (!empty($keyword)) {
            $query->where('product_name', 'LIKE', "%{$keyword}%")
                ->orWhere('price', 'LIKE', "%{$keyword}%");
        }

        if (!empty($company_id)) {
            $query->where('company_id', 'LIKE', "%{$company_id}%");
        }

        // if (!empty($keyword && $company_id)) {
        //     $query->where('company_id', 'product_name', 'stock', 'LIKE', "%{$keyword}%")
        //         ->orWhere('price', 'LIKE', "%{$keyword}%")
        //         ->orWhere('company_id', 'LIKE', "%{$company_id}%");
        // }

        $products = $query->get();

        return view('products.index', ['products' => $products, 'companies' => $companies], compact('products', 'companies', 'keyword'));

        // ->with('companies', $company_name)
        // ->with('products', $company_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_id' => 'required',
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $products = new Product;
        $products->company_id = $request->company_id;
        $products->product_name = $request->product_name;
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->comment = $request->comment;
        // $products->img_path = $request->img_path;

        // $products->file($request->all());

        $img_path = $request->file('img_path');

        $resize_img = Product::make($img_path)->resize(500, 375)->encode($extension);

        if ($img_path) {
            $path = \Storage::disk('public')->putfile('images', $img_path);

            $productsFileName = basename($path);
            $products->img_path = $productsFileName;
        } else {
            $path = null;
        }

        // ２個目//
        // $image = $request->file('img_path')->store('public/images');

        // $image = $request->file('img_path')->store('public/images');

        // $image = str_replace('public/images/', '', $image);

        // $image = new Product;
        // $image->file = $image;


        $products->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $usr_id = $product->usr_id;
        $user_name = DB::table('users')->where('id', $usr_id)->first();

        return view('products.detail', ['product' => $product, 'user_name' => $user_name,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', ['product' => $product, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        //レコードを検索
        try {
            $product = Product::find($id);

            $product->company_id = $request->company_id;
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->img_path = $request->img_path;

            //保存(更新)
            $product->save();
        } catch (\Exception $e) {
            $e->getMessage();
        }
        return redirect()->to('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        //削除
        $product->delete();

        return redirect()->to('/products');
    }

    public function search(Request $request)
    {
        $product = Product::where('product_name', 'like', "%{$request->search}%")
            ->orWhere('stock', 'like', "%{$request->search}%")
            ->paginate(3);


        $search_result = $request->search . 'の検索結果' . $product->total() . '件';

        return view('products.index', [
            'products' => $product,
            'search_result' => $search_result,
            'search_query'  => $request->search
        ]);
    }
}
