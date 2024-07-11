<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BlogController extends Controller 
{


    public function addPost(){

        return view('addPost');

    }

public function addSinglePost(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'short_description' => ['required', 'string', 'max:400'],
            'long_description' => ['required', 'string', 'max:5000'],
        ]);

        $post = Blog::create([
            'title' => $validated['title'],
            'short_description' => $validated['short_description'],
            'long_description' => $validated['long_description'],
            'user_id' => Auth::id(),
        ]);
        return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);
    }


    public function seePost(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        // if (!$user) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
        $blogs = Blog::where('user_id', $user->id)->paginate(5);

        return view('seePost', ['user' => $user, 'blogs' => $blogs]);
    }



    public function destroy($blogId){

        $blog = Blog::find($blogId);

        if (!$blog) {
           return response()->json(['message'=> 'unable to find post'],0);
    }

    $blog->delete();

    return redirect('seePost');

 
}

public function edit($blogId){



    $blog = Blog::find($blogId);

    return view('edit', ['blog'=> $blog]);
}


public function editSinglePost(Request $request, $blogId){


    $validated = $request->validate([
            'title' => ['required', 'string', 'max:15'],
            'short_description' => ['required', 'string', 'max:40'],
            'long_description' => ['required', 'string', 'max:500'],
        ]);

         $post = blog::findOrFail($blogId);

        $post->title = $validated['title'];
        $post->short_description = $validated['short_description'];
        $post->long_description = $validated['long_description'];

        $post->save();

        return redirect('seePost');

}

}
