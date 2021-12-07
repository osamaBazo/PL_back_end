<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ProductController extends Controller
{

    public function index(){
        return response()->json(Product::query()->latest()->get());
    }


    public  function store(Request $request){

        $validator = Validator::make($request->all(), [
            //'categories_name' => ['required' , 'min:3' , 'max:100'],
            'product_name' => ['required', 'min:3', 'max:200'],
            'price' => ['required', 'min:100', 'max:10000000', 'numeric'],
            'description' => ['min:20', 'max:1000'],
            'quantity' => ['min:0', 'max:1000000'],
            'first_discount' => ['required', 'date', 'after:tomorrow'],
            'second_discount' => ['required', 'date', 'after:firstDiscount'],
            'third_discount' => ['required', 'date', 'after:secondDiscount'],
            'first_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'second_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'third_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'expired_date' => ['required', 'date', 'after:thirdDiscount'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(),401);
        }


        $products = Product::query()->create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'first_discount' => $request->first_discount,
            'second_discount' => $request->second_discount,
            'third_discount' => $request->third_discount,
            'first_price' => $request->first_price,
            'second_price' => $request->second_price,
            'third_price' => $request->third_price,
            'expired_date' => $request->expired_date,
            //'categories_name' => Category::query()->firstOrCreate(['name' => $request->categories_name])->select('id')
        ]);
        $products->save();
        return response()->json($products , 201);
    }



    public function show(Product $product){

        return response()->json(Product::query()->firstOrFail($product) , 201);

    }

    public function update(Request $request,Product $product){

        $validator = Validator::make($request->all(), [
            'product_name' => ['required' , 'min:3', 'max:200'],
            'price' => ['required', 'min:100', 'max:10000000', 'numeric'],
            'description' => ['min:20', 'max:1000'],
            'quantity' => ['min:0', 'max:1000000'],
            'first_discount' => ['required', 'date', 'after:tomorrow'],
            'second_discount' => ['required', 'date', 'after:first_discount'],
            'third_discount' => ['required', 'date', 'after:second_discount'],
            'first_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'second_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'third_price' => ['required', 'numeric', 'min:1', 'max:100'],
            'expired_date' => ['required', 'date', 'after:third_discount']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first(),401);
        }

        if($request->expired_date != $product->expired_date){
            // return that the expired date shouldn't be edited
        }

        $product = Product::query()->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'first_discount' => $request->first_discount,
            'second_discount' => $request->second_discount,
            'third_discount' => $request->third_discount,
            'first_price' => $request->first_price,
            'second_price' => $request->second_price,
            'third_price' => $request->third_price,
            'expired_date' => $request->expired_date,
        ]);

        return response()->json($product , 201);




    }
    public function destroy(Product $product){

        $product->delete();

        return response()->json($product,201);
    }
}
