<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfileForm()
    {
        $user = Auth::user();
        $profile = $user->profile ?: new Profile(['user_id' => $user->id]);

        // Jika profil belum ada, buat profil baru dengan default values
        if (!$profile) {
            $profile = new Profile(['user_id' => $user->id]);
        }

    return view('profile', ['title' => 'Lengkapi Profile mu!', 'profile' => $profile]);
    }

    public function update(Request $request)
    {
        Log::info('Request data: ', $request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'country' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'postal_code' => 'string|max:255',
            'about' => 'nullable|string',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //Mendapatkan pengguna yang sedang login.
        $user = Auth::user();
        //Memperoleh profil pengguna atau membuat profil baru jika belum ada.
        $profile = $user->profile ?? new Profile(['user_id' => $user->id]);


        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            Log::info('File uploaded:', ['file' => $file]);
        
            if ($file->isValid()) {
                $filePath = $file->store('profile_photos', 'public');
                Log::info('File stored at:', ['filePath' => $filePath]);
                $profile->profile_photo = $filePath;
            } else {
                Log::warning('Uploaded file is not valid.');
                return back()->withErrors(['profile_photo' => 'Uploaded file is not valid.']);
            }
        } else {
            Log::warning('No file uploaded.');
        }
        

        // Update profil pengguna dengan data yang valid
        $profile->fill($request->only([
            'name', 'email', 'country', 'street_address', 'city', 'region', 'postal_code', 'about'
        ]));

        //Menyimpan profil ke database.
        $profile->save();
        Log::info('Profile saved successfully');

        return redirect()->route('profile.update')->with('success', 'Profile updated successfully!');
}
}
