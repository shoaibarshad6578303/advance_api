<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function test()
    {
       return "test";
    }
    
    public function index()
    {
        dd("hello");
        try{
        $products=Product::All();
        return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.', 200);
        }catch(\Exception $exception){
            return $this->sendError('SERVER_ERROR ', $exception->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 400);       
        }
   
        try{
            $product = Product::create($input);
            return $this->sendResponse(new ProductResource($product), 'Product created successfully.', 201);
        }catch(\Exception $exception){
            return $this->sendError('SERVER_ERROR ', $exception->getMessage(), 500);
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd("show");
        try{
            $product = Product::findOrFail($product);
            return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
        }catch(\Exception $exception){
        
            return $this->sendError('SERVER_ERROR ', $exception->getMessage(), 500);       
    }
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
        dd("update");
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(),400);       
        }
      
        try{

            $product->name = $input['name'];
            $product->detail = $input['detail'];
            $product->save();
       
            return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');

        }catch(\Exception $exception){
            return $this->sendError('SERVER_ERROR ', $exception->getMessage(), 500);        
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try{

            $product->delete();
            return $this->sendResponse([], 'Product deleted successfully.',204);

        }catch(\Exception $exception){
            return $this->sendError('SERVER_ERROR ', $exception->getMessage(), 500);         
        }
        
    }
}
