<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request){

    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

    if (!$user) {
        return back()->withErrors(['email' => 'The email address is not registered.'])->withInput($request->only('email'));
    }

    if($user->is_admin==1){
        $token=$user->createToken('auth-token')->plainTextToken;
          $users = User::paginate(20);
        $blogs = blog::paginate(20);

        return view('admin', compact('users', 'blogs',));
    }
    }


    public function loadMoreUsers($page)
    {
        $users = User::paginate(10, ['*'], 'page', $page);

        return response()->json($users);
    }


    public function allblogs(){
        return view('allBlogs', ['blogs'=> blog::paginate(20)]);
    }



   public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        if (!$blog) {
            return redirect('/allblogs')->with('error', 'Blog not found.');
        }
        $blog->delete();
        return redirect('/allblogs')->with('success', 'Blog deleted successfully.');
    }
   
}
