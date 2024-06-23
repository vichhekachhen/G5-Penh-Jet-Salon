<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request)
    {
        $data= $request->all();
        $data['user_id'] = Auth::user()->id;
        $Province = Province::create($data);
        return redirect()->back('')->withSuccess('Province created successfully !!!');
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
    public function update(Request $request, Province $province)
    {
        $province->update($request->all());
        return redirect()->back()->withSuccess('Province updated !!!');
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
