<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePlantsRequest;
use App\Models\Plants;
use Illuminate\Http\Request;

/**
 * Summary of PlantsController
 */
class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plants::with('category')->get();
        return response()->json([
            'status'=>true,
            'songs'=>$plants
        ]);

    }

    public function store(StorePlantsRequest $request)
    {
        $plant = Plants::create($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'Plant created Successfully !',
            'song'=>$plant,
        ],200);
    }

    public function show(Plants $plant)
    {
        $plant = $plant->load('category:id,category_name');
        return response()->json([
            'status'=>true,
            'song'=>$plant
        ],200);
    }
    public function update(StorePlantsRequest $request, Plants $plant)
    {
        $plant->update($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'Song updated Successfully !',
            'song'=>$plant,
        ],200);
    }

    public function destroy(Plants $plant)
    {
        $plant->delete();
        return response()->json([
            'status'=>true,
            'message'=>'Song deleted Successfully !',
        ],200);
    }

}
