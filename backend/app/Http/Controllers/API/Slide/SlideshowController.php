<?php

namespace App\Http\Controllers\API\Slide;

use App\Http\Controllers\Controller;
use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = Slideshow::all();
        return response()->json([
            'success'=> true,
            'message' => 'All Slides',
            'data' => $slides,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'  => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/SlideImages');
            $SlideImages = Storage::url($path);
        } else {
            $SlideImages = null;
        }

        $slide = Slideshow::create([
            'image' => $SlideImages,
            'title' => $request->title,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Slide created successfully',
            'data' => $slide,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slide = Slideshow::find($id);
        $slide->delete();
        return response()->json([
            'success'=> true,
            'message' => 'Slide deleted successfully',
      ]);
    }
}
