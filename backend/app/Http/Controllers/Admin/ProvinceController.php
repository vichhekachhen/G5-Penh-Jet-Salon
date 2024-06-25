<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Province access|Province create|Province edit|Province delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Province create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Province edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Province delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::paginate(4);

        return view('province.index',['provinces'=>$provinces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('province.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'province_name' => 'required|string|unique:provinces,province_name',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
    
    //     // Get all input data
    //     // $data = $request->all();
    //     $data = $request->except('image');
    
    //     // Add user ID to the data
    //     $data['user_id'] = Auth::user()->id;
    
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $path = $image->store('ProvinceImages', 'public');
    //         $data['image'] = Storage::url($path);
    //     }
    
    //     // Create a new Province record
    //     $province = Province::create($data);
    
    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Province created successfully !!!');
    // }

    public function store(Request $request)
{
    // Validate the request including the image
    $request->validate([
        'province_name' => 'required|string|unique:provinces,province_name',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Get all input data except for the image
    $data = $request->except('image');
    
    // Add user ID to the data
    $data['user_id'] = Auth::user()->id;

    // Check if the request has an image file
    if ($request->hasFile('image')) {
        // Store the image and get its path
        $path = $request->file('image')->store('ProvinceImages', 'public');
        // Get the URL for the stored image
        $data['image'] = Storage::url($path);
    }else{
        $data['image'] = null;
    }

    // Create a new Province record
    $province = Province::create($data);

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Province created successfully !!!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
       return view('province.edit',['province' => $province]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Province $province)
    // {
    //     $request->validate([
    //         'province_name' => 'required|string|unique:provinces,province_name',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     ]);
    
    //     // Get all input data except for the image
    //     $data = $request->except('image');
        
    //     // Check if the request has an image file
    //     if ($request->hasFile('image')) {
    //         // Store the image and get its path
    //         $path = $request->file('image')->store('ProvinceImages', 'public');
    //         // Get the URL for the stored image
    //         $data['image'] = Storage::url($path);
    //     }
    //     $province->update($request->all());

    //     return redirect()->back()->withSuccess('Province updated !!!');
    // }

    public function update(Request $request, $id)
{
    $province = Province::findOrFail($id);
    $rules = [
        'province_name' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
    // If the province name is being updated, add a unique constraint
    if ($request->province_name !== $province->province_name) {
        $rules['province_name'] .= '|unique:provinces,province_name';
    }
    $request->validate($rules);
    $data = $request->except('image');
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($province->image) {
            $oldImagePath = str_replace('/storage', 'public', $province->image);
            Storage::delete($oldImagePath);
        }

        // Store the new image and get its path
        $path = $request->file('image')->store('ProvinceImages', 'public');
        $data['image'] = Storage::url($path);
    }
    $province->update($data);

    return redirect()->back()->with('success', 'Province updated successfully !!!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->back()->withSuccess('Province deleted !!!');
    }
}
