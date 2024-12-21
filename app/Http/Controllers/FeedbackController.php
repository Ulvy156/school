<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Feedback::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "message" => "required|string",
                "user_id" => "required|integer"
            ]);
            $feedback = new Feedback();
            $feedback->message = $request->message;
            $feedback->user_id = $request->user_id;
            $feedback->save();
            return response()->json(["message" => "Feedback created successfully"], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            return Feedback::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 404);
        }
    }

  
    public function update(Request $request, Feedback $feedback)
    {
        try {
            $request->validate([
                "message" => "required|string",
                "user_id" => "required|integer"
            ]);
            $feedback->message = $request->message;
            $feedback->user_id = $request->user_id;
            $feedback->save();
            return response()->json(["message" => "Feedback updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();
            return response()->json(["message" => "Feedback deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
