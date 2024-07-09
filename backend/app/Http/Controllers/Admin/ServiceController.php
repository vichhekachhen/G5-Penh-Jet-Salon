<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Service;
use App\Models\Slideshow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Service access|Service create|Service edit|Service delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Service create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Service edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Service delete', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:Service show', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::paginate(4);

        return view('service.index', compact('services'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('service.new', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user);
        $request->validate([
            'service_name' => 'required|string',
            'price' => 'required|integer',
            'discription' => 'nullable|string|max:2048',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('SlideshowImages', 'public');
            $data['image'] = Storage::url($path);
        } else {
            $data['image'] = null;
        }

        $service = Service::create([
            'service_name' => $request->service_name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'store_id' => $user->store_id,
            'discount' => $request->discount,
            'image' => $data['image'],
            'category_id' => $request->category_id
        ]);
        return redirect('/admin/services')->with('success', 'Service created successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('service.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('service.edit', ['service' => $service, 'categories'=> $categories]);	
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
        return redirect('/admin/slideshows')->with('success', 'Slideshow updated successfully !!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->withSuccess('Service deleted !!!');
    }
}
