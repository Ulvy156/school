<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Rating::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "rating" => "required|integer",
                "universitie_id" => "required|integer",
                "user_id" => "required|integer"
            ]);
            $rating = new Rating();
            $rating->rating = $request->rating;
            $rating->universitie_id = $request->universitie_id;
            $rating->user_id = $request->user_id;
            $rating->save();
            return response()->json(["message" => "Rating created successfully"], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        try {
            return Rating::findOrFail($rating);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        try {
            $request->validate([
                "rating" => "required|integer",
                "user_id" => "required|integer",
                "universitie_id" => "required|integer"
            ]);
            $rating->rating = $request->rating;
            $rating->user_id = $request->user_id;
            $rating->universitie_id = $request->universitie_id;
            $rating->save();
            return response()->json(["message" => "Rating updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        try {
            $rating->delete();
            return response()->json(["message" => "Rating deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
