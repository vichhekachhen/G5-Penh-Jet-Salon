<?php

namespace App\Http\Controllers;

use App\Models\sender;
use Illuminate\Http\Request;
use App\Http\Resources\senderResource;

class SenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $senders = sender::all();
        return response()->json([
            'data' => SenderResource::collection($senders)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(sender $sender)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sender $sender)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sender $sender)
    {
        //
    }
}
