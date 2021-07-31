<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use Exception;
use Illuminate\Http\Request;

class LaptopController extends Controller
{
    public function show(Laptop $laptop) {
        return response()->json($laptop,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $laptops = Laptop::where('brand','like',"%$request->key%")
            ->orWhere('description','like',"%$request->key%")->get();

        return response()->json($laptops, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'brand' => 'string|required',
            'model' => 'string|required',
            'description' => 'string|required',
            'price' => 'numeric|required',
        ]);

        try {

            $laptop =  Laptop::create([
                "brand" => $request->brand,
                "model"=> $request->model,
                "description"=>$request->description,
                "price"=>$request->price,
              

            ]);

            return response()->json($laptop, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Laptop $laptop) {
        try {
            $laptop->update($request->all());
            return response()->json($laptop, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Laptop $laptop) {
        $laptop->delete();
        return response()->json(['message'=>'Laptop deleted.'],202);
    }

    public function index() {
        $laptops = Laptop::where('user_id', auth()->user()->id)->orderBy('brand')->get();
        return response()->json($Laptops, 200);
    }
}
