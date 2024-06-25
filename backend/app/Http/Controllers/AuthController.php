<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use App\Models\Address;
use App\Models\Province;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user   = User::where('email', $request->email)->firstOrFail();
        $token  = $user->createToken('auth_token')->plainTextToken;
        $roles = $user->getRoleNames();

        return response()->json([
            'message'       => 'Login success',
            'access_token'  => $token,
            'role'  => $roles,
            'token_type'    => 'Bearer'
        ]);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function index(Request $request)
    {
        $user = $request->user();
        // $permissions = $user->getAllPermissions();
        // $roles = $user->getRoleNames();
        return response()->json([
            'message' => 'Login success',
            'data' => $user,
        ]);
    }

    public function register(Request $request): JsonResponse
    {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gender' => ['required', 'in:male,female,other'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => Gender::from($request['gender']),
            'store_id' => 0,
        ]);

        // Generate a token for the user
        $token = $user->createToken('authToken')->accessToken;
        //role
        $roles = Role::all();
        $userRole = null;
        foreach ($roles as $key => $role) {
            if ($role['name'] === 'user') {
                $userRole = $role;
            }
        }
        $user->syncRoles($userRole);

        // Return a success response
        return response()->json([
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function registerOwner(Request $request): JsonResponse
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'shop_name' => 'required|string|max:255',
        'province_id' => 'required', 
        'city' => 'required|string|max:255',
        'gender' => 'required|in:male,female,other',
        'shop_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422);
    }

    // Handle the file upload for shop_profile
    if ($request->hasFile('shop_profile')) {
        $path = $request->file('shop_profile')->store('public/StoreImages');
        $shopProfileUrl = Storage::url($path);
    } else {
        $shopProfileUrl = null;
    }

    // Create the address
    $address = Address::create([
        'city' => $request->city,
        'province_id' => $request->province_id,
    ]);

    // Create the store
    $store = Store::create([
        'shop_name' => $request->shop_name,
        'shop_profile' => $shopProfileUrl,
        'address_id' => $address->id,
    ]);

    // Create the user
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender' => Gender::from($request->gender),
        'store_id' => $store->id,
    ]);

    // Assign role to the user
    $ownerRole = Role::where('name', 'owner')->first();
    if ($ownerRole) {
        $user->assignRole($ownerRole);
    }

    // Generate a token for the user
    $token = $user->createToken('authToken')->accessToken;

    // Return a success response
    return response()->json([
        'message' => 'Registration successful',
        'access_token' => $token,
        'token_type' => 'Bearer',
    ], 201);
}

}
