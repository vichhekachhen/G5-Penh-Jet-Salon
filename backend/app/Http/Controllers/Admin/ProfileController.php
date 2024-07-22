<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use UploadImage;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('setting.profile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'phone' => 'nullable|unique:users,phone,' . $user->id . ',id',
            'profile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
            'birth' => 'required|date',
        ]);

        // Update the user's phone number if it's provided
        if ($request->filled('phone')) {
            $user->phone = $request->input('phone');
        }

        // Update the user's birth date
        $user->birth = $request->input('birth');

        // Update the password if provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                $oldImagePath = str_replace('/storage', 'public', $user->profile);
                Storage::delete($oldImagePath);
            }

            // Store the new profile and get its path
            $path = $request->file('profile')->store('Profiles', 'public');
            $data['profile'] = Storage::url($path);
        }
        $user->profile = $data['profile'];
        $user->save();

        return redirect()->back()->withSuccess('User updated successfully!');
    }
}
