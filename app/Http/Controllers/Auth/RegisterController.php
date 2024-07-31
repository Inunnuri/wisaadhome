<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

    class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register', ['title' => 'Registrasi']);
    }


    public function register(Request $request)
    {
         Log::info('Request Data:', $request->all());
         //Memvalidasi input pengguna menggunakan metode validator.
         $this->validator($request->all())->validate();
         //Membuat pengguna baru menggunakan metode create.
         $user = $this->create($request->all());
 
         //Mencatat data pengguna setelah pembuatan.
         Log::info('User Created:', $user->toArray());
 
         // Login user secara otomatis setelah registrasi
         auth()->login($user);
 
         return redirect()->route('home')->with('success', 'Registration successful!');
    }

    //sesuaikan dengan struktur table
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    //sesuaikan dengan struktur table
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}

// done

