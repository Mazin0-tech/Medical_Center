<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
       
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'email' => 'required|string|email|max:255|unique:users|regex:/^[\w-]+(\.[\w-]+)*@([A-Za-z0-9-]+\.)+[A-Za-z]{2,6}$/',
            'password' => 'required|string|confirmed|min:8',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'role' => 'nullable|in:admin,doctor,patient',
        ]);

       
        $role = $request->role ?: 'patient'; 

        
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->role = $role; 

       
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/created'), $imageName);
            $user->image = "/img/created/{$imageName}"; 
        }

      
        $user->save();

       
        Auth::login($user);

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
