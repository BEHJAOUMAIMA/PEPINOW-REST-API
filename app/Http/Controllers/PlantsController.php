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

}
