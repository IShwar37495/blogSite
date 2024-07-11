<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\userController;
use App\Models\blog;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $blog = blog:: orderBy('created_at', 'desc')->paginate(10); 
    return view('index', ['blogs' => $blog]); 
})->name('home');

Route::get('/blogs/{id}', function ($id) {
    $blog = blog::findOrFail($id);
    $comments = $blog->comments()->with('user')->take(3)->get();
    return view('blog', ['blog' => $blog, 'comments' => $comments]);
})->name('blog.show');

Route::get('/blogs/{id}/comments', function ($id) {
    $page = request()->query('page', 1);
    $blog = blog::findOrFail($id);
    $comments = $blog->comments()->orderBy('created_at', 'desc')->with('user')->skip(($page - 1) * 3)->take(3)->get();
    return response()->json($comments);
});


Route::get('/login', function(){


    return view('login');
})->name('login');


Route::post('/login/user', function(Request $request) {
    $credentials = $request->only('email', 'password');

    $user = User::where('email', $credentials['email'])->first();

       if (!$user) {
        return back()->withErrors(['email' => 'The email address is not registered.'])->withInput($request->only('email'));
       }
       if(Auth::attempt($credentials)) {
        $token = $user->createToken('auth-token')->plainTextToken;
        return redirect()->intended('/')->with('token', $token);
    }
    return back()->withErrors(['password' => 'Invalid credentials.'])->withInput($request->only('email'));
})->name('login.user');


//Admin Routes

Route::post('/login/admin', [AdminController::class, 'login'])->name('login.admin');
Route::get('/loadMore/{page}', [AdminController::class, 'loadMoreUsers'])->name('load.more.users');
Route::get('/allblogs', [AdminController::class,'allblogs'])->name('admin.index');
Route::delete('/deleteBlog/{id}', [AdminController::class,'deleteBlog'])->name('blog.delete');


//User Routes
Route::get('/signup', [userController::class, 'signup'])->name('signup');

Route::post('/signup', [userController::class,'signupUser'])->name('signupUser');

Route::post('/logout', [userController::class,'logout'])->name('logout');

Route::get('/profile', [userController::class, 'profile'])->name('profile');

Route::get('/profile/{userId}', [userController::class,'seeProfile'])->name('seeProfile');




//Blog Routes
Route::get('/addPost', [BlogController::class,'addPost'])->middleware('custom.auth')->name('addPost'); // here we used custom auth middlware which we have created our own.

Route::post('/addSinglePost', [BlogController::class,'addSinglePost'])->middleware('auth')->name('addSinglePost');

Route::get('/seePost', [BlogController::class,'seePost'])->middleware('auth')->name('seePost');

Route::get('/posts/{post}/edit', [BlogController::class, 'edit'])->middleware('auth')->name('editPost');

Route::delete('/posts/{post}', [BlogController::class, 'destroy'])->middleware('auth')->name('deletePost');

Route::put('/edit/{blogId}', [BlogController::class,'editSinglePost'])->middleware('auth')->name('edit');





//Comment Routes
Route::post('/addComment', [CommentController::class, 'addComment'])->middleware('auth')->name('addComment');




Route::fallback(function () {
    return view('notAPage');
});

Route::get('/customLogin', function(){

    return view('customLogin');
})->name('customLogin');
















