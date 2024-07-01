<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Slideshow access|Slideshow create|Slideshow edit|Slideshow delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Slideshow create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Slideshow edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Slideshow delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slideshows = Slideshow::paginate(4);

        return view('slideshow.index', compact('slideshows'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slideshow.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('SlideshowImages', 'public');
            $data['image'] = Storage::url($path);
        } else {
            $data['image'] = null;
        }

        Slideshow::create($data);
        return redirect()->back()->with('success', 'Slideshow created successfully !!!');
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
    public function edit(Slideshow $slideshow)
    {
        return view('slideshow.edit', ['slideshow' => $slideshow]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $slideshow = Slideshow::findOrFail($id);
        $rules = [
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        $request->validate($rules);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            if ($slideshow->image) {
                $oldImagePath = str_replace('/storage', 'public', $slideshow->image);
                Storage::delete($oldImagePath);
            }

            $path = $request->file('image')->store('ProvinceImages', 'public');
            $data['image'] = Storage::url($path);
        }
        $slideshow->update($data);

        return redirect()->back()->with('success', 'Slideshow updated successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slideshow $slideshow)
    {
        $slideshow->delete();
        return redirect()->back()->withSuccess('Slideshow deleted !!!');
    }
}
