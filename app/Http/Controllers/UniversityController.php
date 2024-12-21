<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return University::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => "required|string",
            ]);
            $university = new University();
            $university->name = $request->name;
            $university->save();
            return response()->json(["message" => "University created successfully"], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university)
    {
        try {
            return University::findOrFail($university);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university)
    {
        try {
            $request->validate([
                "name" => "required|string"
            ]);
            $university->name = $request->name;
            $university->save();
            return response()->json(["message" => "University updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university)
    {
        try {
            $university->delete();
            return response()->json(["message" => "University deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
