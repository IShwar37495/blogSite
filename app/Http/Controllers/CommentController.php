<?php

namespace App\Http\Controllers;

use App\Models\blog;
use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
      public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
            'blog_id' => 'required|integer|exists:blogs,id',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = Auth::id();
        $comment->blog_id = $request->blog_id;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

       
    }



