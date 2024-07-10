<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $provinces = Province::all();
        return view('auth.register', ['provinces' => $provinces]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::ADMIN_HOME);
    }
}

// public function store(Request $request)
// {
//     dd($request);
//     $request->validate([
//         'name' => ['required', 'string', 'max:255'],
//         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//         'password' => ['required', 'confirmed', Rules\Password::defaults()],
//         'shop_name' => ['required', 'string'],
//         'province_id' => ['required', 'integer'],
//         'city' => ['required', 'string'],
//         'gender' => ['required', 'in:male,female,other'],
//         'shop_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//     ]);

    
//     // Handle the file upload for shop_profile
//     if ($request->hasFile('shop_profile')) {
//         $path = $request->file('shop_profile')->store('public/StoreImages');
//         $shopProfileUrl = Storage::url($path);
//     } else {
//         $shopProfileUrl = null;
//     }
    
//     // Create the address
//     $address = Address::create([
//         'city' => $request->city,
//         'province_id' => $request->province_id,
//     ]);
    
//     // Create the store
//     $store = Store::create([
//         'shop_name' => $request->shop_name,
//         'shop_profile' => $shopProfileUrl,
//         'address_id' => $address->id,
//     ]);

//     $user = Frontuser::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'gender' => Gender::from($request->gender),
//         'store_id' => $store->id,
//     ]);

//     // Assign role to the user
//     $ownerRole = Role::where('name', 'owner')->first();
//     if ($ownerRole) {
//         $user->assignRole($ownerRole);
//     }

//     event(new Registered($user));

//     Auth::guard('front')->login($user);

//     return redirect(RouteServiceProvider::HOME);
// }