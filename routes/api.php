<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/// get all posts
Route::get("/posts", function () {
    return Post::all();
});

/// insert to post
Route::post("/posts/insert", function (){
    return Post::create([
        "title"=> request("title"),
        "content" => request("content")
    ]);
});

/// search post
Route::get("/post/search/{id}", function (){
    return Post::findOrFail(request("id"));
});

/// update a post
Route::post("/post/update/{id}/{title}/{content}", function () {
    $post = Post::find(request("id"));
    $post->title = request("title");
    $post->content = request("content");
    $post->update();
    return "Updated !";
});

/// delete post
Route::post("/post/delete/{id}", function () {
    return Post::where("id", request("id"))->firstorfail()->delete();
});
