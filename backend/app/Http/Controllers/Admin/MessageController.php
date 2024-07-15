<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Message access|Message create|Message edit|Message delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:Message create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:Message edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:Message delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('message.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('message.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the request including the image
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);

        Category::create($data);

        // Redirect back with a success message
        return redirect('/admin/categories')->with('success', 'Category created successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('message.edit', ['message' => $category]);
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
        $category = Category::findOrFail($id);
        $rules = [
            'name' => 'required|string',
        ];
        if ($request->name !== $category->name) {
            $rules['name'] .= '|unique:categories,name';
        }
        $data = $request->validate($rules);
        $category->update($data);

        return redirect('/admin/categories')->with('success', 'Category updated successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->withSuccess('Category deleted !!!');
    }
}
