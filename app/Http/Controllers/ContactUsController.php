<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ContactUs::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                "major" => "required|string",
                "description" => "required|email",
                "user_id" => "required|integer"
            ]);
            $contactUs = new ContactUs();
            $contactUs->major = $request->major;
            $contactUs->description = $request->description;
            $contactUs->user_id = $request->user_id;
            $contactUs->save();
            return response()->json(["message" => "Contact us message created successfully"], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactUs $contactUs)
    {
        try {
            return ContactUs::findOrFail($contactUs);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        try {
            $request->validate([
                "major" => "required|string",
                "description" => "required|email",
                "user_id" => "required|integer"
            ]);
            $contactUs->major = $request->major;
            $contactUs->description = $request->description;
            $contactUs->user_id = $request->user_id;
            $contactUs->save();
            return response()->json(["message" => "Contact us message updated successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        try {
            $contactUs->delete();
            return response()->json(["message" => "Contact us message deleted successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["message" => $th->getMessage()], 500);
        }
    }
}
