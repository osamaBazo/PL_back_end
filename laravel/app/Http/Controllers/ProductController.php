<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller
{
    public  function store(Request $request){

        $valid = Validator::make($request->all(),[
            'name' => ['required', 'string', 'max:25'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => [],
        ]);

        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->img_url = $request->input('img_url');
        $product->quantity = $request->input('quantity');
        $product->category = $request->input('category');
        $product->price = $request->input('price');
        $product->expire_date = $request->input('expire_date');
        $product->owner_id = $request->input('owner_id');
        // to do owner id token

        $product->save();
    }

    public function index(){
        //$product = Product::all();
        $product = Product::query()->latest()->get();
        //$price = $this->selectPrice($product);
        $jsonContent =json_decode($product, true);
        return response()->json(['products'=> $jsonContent], 200);
    }

    public function show(Request $request, $id){
        if(Product::where('id', $id)->exists()){
            $product = Product::where('id', $id)->first();
            return response()-> json([
                'status'=> 1,
                'Product details'=> $product
            ]);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'Product not found'
            ],404);
        }
        /*
        // search for a product
        $searchKey = $request->input('searchKey');
        $searchValue = $request->input('searchValue');
        $product = Product::where($searchKey,$searchValue)->get();
        $jsonContent = json_decode($product,true);
        return response()-> json([
            'product'=> $jsonContent
        ]);*/
    }
    public function update(Request $request, $id){
        if(Product::where('id', $id)->exists()){
            $product = Product::find($id);

            $product->name = !empty($request->input('name')) ? $request->input('name') : $product->name;
            $product->description = !empty($request->input('description')) ? $request->input('description') : $product->description;
            $product->img_url = !empty($request->input('img_url')) ? $request->input('img_url') : $product->img_url;
            $product->quantity = !empty($request->input('quantity')) ? $request->input('quantity') : $product->quantity;
            $product->category = !empty($request->input('category')) ? $request->input('category') : $product->category;
            $product->price = !empty($request->input('price')) ? $request->input('price') : $product->price;
            $product->expire_date = !empty($request->input('expire_date')) ? $request->input('expire_date') : $product->expire_date;
            $product->owner_id = !empty($request->input('owner_id')) ? $request->input('owner_id') : $product->owner_id;

            $product->save();
            return response()-> json([
                'message'=>'Product Updated Successfully'
            ], 200);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'Product not found'
            ],404);
        }

    }
    public function destroy(Request $request, $id){
        if(Product::where('id', $id)->exists()){
            $product = Product::find($id);
            $product->delete();
            return response()-> json([
                'status'=> 1,
                'message'=> 'product deleted successfully'
            ]);
        }else{
            return response([
                'status'=> 0,
                'message'=> 'Product not found'
            ],404);
        }
    }
}
