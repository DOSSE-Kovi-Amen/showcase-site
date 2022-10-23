<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Project;
use App\Models\Newsletter;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // Display three last posts
    $last_posts=Post::limit(3)->orderBy('updated_at',"desc")->get();
    $projects=Project::orderBy('updated_at','desc')->get();

    return view('welcome',compact('last_posts','projects'));
});

Route::get('about', function () {
    return view('about');
});

Route::get('blog', function () {
    $categories =Category::all();
    $posts=Post::orderBy('updated_at','desc')->paginate(60);
    return view('blog', compact('posts', 'categories'));
});

Route::get('blog/category/{slug}', function ($slug) {
    $category=Category::where('slug','=',$slug)->firstOrFail();
    $categories =Category::all();
    $posts=Post::where('category_id','=',$category->id)
    ->paginate(60);
    return view('blog', compact('posts', 'categories'));
});

Route::get('blog/article/{category}/{slug}', function ($category,$slug) {
    $last_posts=Post::limit(6)->orderBy('updated_at',"desc")->get();
    $article=Post::where('slug','=',$slug)->firstOrFail();
    return view('article', compact('article','last_posts'));
});

Route::get('blog/search', function (Request $request) {
    $categories =Category::all();
    if($request==null){
        $posts=Post::all()
        ->paginate(60);
    }
    else{
    $posts=Post::where('title','LIKE','%'.$request->search.'%')
    ->paginate(60);
    }

    return view('blog', compact('posts', 'categories'));
});

Route::get('projects', function () {
    $projects=Project::orderBy('updated_at','desc')->paginate(60);
    return view('projects',compact('projects'));
});

Route::post('newsletters', function (Request $request) {
 Newsletter::create(['email'=>$request->email]);
 return back();
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
