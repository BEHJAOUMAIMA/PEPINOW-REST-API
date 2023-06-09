<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantsRequest;
use App\Models\Plants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'success' => true,
            "message" => "All Plants",
            'plants' => $plants
        ]);

    }

    public function store(StorePlantsRequest $request)
    {
        //  générer un nom de fichier unique
        $nameFile = now()->format('YmdHisu') . '.' . $request->file('image')->getClientOriginalExtension();
        // Stocker l'image dans le système de fichiers local
        $request->file('image')->move(public_path('images'), $nameFile);
        // obtenir son URL à l'aide de la fonction asset()
        $urlImg = asset('images/' . $nameFile);

        $plant = Plants::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $urlImg,
            'category_id' => $request->category_id,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Plant created Successfully !',
            'plant' => $plant,
        ], 200);
    }

    public function show($plant)
    {

        // $plant = DB::table('plants')
        //         ->join('categories', 'plants.category_id', '=', 'categories.id')
        //         ->select('plants.*', 'categories.id AS category_id', 'categories.category_name')
        //         ->where('plants.id', $plant)
        //         ->first();
        // return response()->json([
        //     'status' => true,
        //     'data' => $plant
        // ], 200);

        $plant = Plants::find($plant);
        return response()->json([
            'status' => true,
            'data' => $plant
        ], 200);

    }
    public function update(StorePlantsRequest $request, $plant)
    {
        $plant = Plants::find($plant);
        $plant->update($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Plant updated Successfully !',
            'data' => $plant,
        ], 200);
    }

    public function destroy(Plants $plant)
    {
        $plant->delete();
        return response()->json([
            'status' => true,
            'message' => 'Plant deleted Successfully !',
        ], 200);
    }

    public function filterCategory($category)
    {
        $plants = Plants::where('category_id', $category)
            ->orWhereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->get();

        if ($plants->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Plants',
            'data' => $plants,
        ], 200);

    }
}
