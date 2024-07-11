<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller




{

     private array $relations = ['blog', 'comment'];
    public function signup(){

        return view('signup');

    }



      public function signupUser(Request $request)
    {

         
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'profile_pic'=>' nullable|image',
        ]);
       if ($request->hasFile('profile_pic')) {
        $validated['profile_pic'] = $request->file('profile_pic')->store('profile_pic', 'public');
    } else {
        $validated['profile_pic'] = null;
    }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
            'profile_pic'=>$validated['profile_pic'],
        ]);

        // Redirect to the login page
        return redirect()->route('login')->with('success', 'Account created successfully. Please login.');
    }



public function profile(Request $request)
{
    $user = $request->user();
    
    if(!$user){

        return redirect()->route('login');
    }

    return view('profile', ['user' => $user]);
}




public function seeProfile(Request $request, $userId){

  $user = User::find($userId);
   $user->load('blogs');

  return view('seeProfile', ['user'=> $user]);



}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('login')->with('success', 'Logged out successfully');
}







}
