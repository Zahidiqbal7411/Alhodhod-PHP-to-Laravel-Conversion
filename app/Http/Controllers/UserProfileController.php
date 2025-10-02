<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = User::get();
        return view('user_profile.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $profile_img = $request->file('image');
            $fileName = time() . '_' . $profile_img->getClientOriginalName();
            $profile_img->move(public_path('uploadimage/profile_image'), $fileName);

            $profile_img_path = 'uploadimage/profile_image/' . $fileName;

            // ✅ Update only logged-in user's image
            User::where('id', 1)->update([
                'profile_image' => $profile_img_path,
            ]);
        }

        return redirect()->back()->with('success', 'Profile Image Uploaded Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user_imgs = User::findorFail($id);
        return view('user_profile.edit', compact('user_imgs'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, string $id)
{
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user_file = User::findOrFail($id);

    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($user_file->profile_image && file_exists(public_path($user_file->profile_image))) {
            unlink(public_path($user_file->profile_image));
        }

        // Save new image
        $profile_img = $request->file('image');
        $fileName = time() . '_' . $profile_img->getClientOriginalName();
        $profile_img->move(public_path('uploadimage/profile_image'), $fileName);

        $profile_img_path = 'uploadimage/profile_image/' . $fileName;
        $user_file->profile_image = $profile_img_path;
        $user_file->save();
    }

    return redirect()->back()->with('success', 'Profile Image Uploaded Successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
