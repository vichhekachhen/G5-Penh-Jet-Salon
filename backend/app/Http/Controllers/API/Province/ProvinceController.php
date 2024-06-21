<?php

namespace App\Http\Controllers\APi\Province;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::all();
        return response()->json([
            'success'=> true,
            'message' => 'All provinces',
            'data' => $provinces,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $province = Province::create(['province_name' => $request->province_name]);
        return response()->json([
              'success'=> true,
              'message' => 'Province created successfully',
              'data' => $province,
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
        $province = Province::find($id);
        $province->update([$request]);
        return response()->json([
            'success'=> true,
            'message' => 'Province updated successfully',
            'data' => $province
      ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $province = Province::find($id);
        $province->delete();
        return response()->json([
            'success'=> true,
            'message' => 'Province deleted successfully',
      ]);
    }
}
