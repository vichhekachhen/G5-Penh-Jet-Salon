<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index', 'show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::latest()->get();

        return view('setting.user.index', ['users' => $user]);
    }
    public function getOwner()
    {
        $users = User::with('roles')->get();
        $userAuth = Auth::user();
        $services = Service::where('store_id', $userAuth->store_id)->get();
        $countService = $services->count();
        $provices = Province::all();
        $countProvince = $provices->count();

        // $owners = [];
        $countOwner = 0;
        $countCustomer = 0;

        foreach ($users as $user) {
            foreach ($user->roles as $role) {
                if ($role->name === 'owner' && $user->store_id != 0) {
                    // $owners[] = $user;
                    $countOwner++;
                } elseif ($role->name === 'user') {
                    $countCustomer++;
                }
            }
        }

        return view('dashboard', ['countOwner' => $countOwner, 'countCustomer' => $countCustomer, 'services' => $services, 'countService'=> $countService, 'countProvince' => $countProvince]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('setting.user.new', ['roles' => $roles]);
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User created !!!');
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
    public function edit(User $user)
    {
        $role = Role::get();
        $user->roles;
        return view('setting.user.edit', ['user' => $user, 'roles' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
        ]);

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        $user->syncRoles($request->roles);
        return redirect()->back()->withSuccess('User updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->withSuccess('Role deleted !!!');
    }
}
