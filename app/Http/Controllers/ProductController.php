<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Auth;
use session;
use Validator;
use Image;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->Authorization);
        // return auth()->user()->name;
        
        $products=Product::all();
        return view("product.index",compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tanda="save";
        return view("product.create", compact("tanda"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'price'=> 'required|numeric',
            "code"=>"required|string|max:10|unique:products",
            "name"=>"required|string|max:50",
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $img = Image::make($request->image->getRealPath());
        $img->save(public_path('/images').'/'.$request->code.".jpg");
        $data=$request->all();
        $data['image']=$request->code.".jpg";
        Product::create($data);

        // return "berhasil";
        // return redirect("product");
        $success = "b";
        
        return Response::json(compact('success'));



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
