<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        //dd($request);
    
        $authors = User::has('posts')->get();

        // Prepare Data
        $author_id = '';
        $sort_by_date = '';
        $posts = Post::where('title', '!=', '');
        if ($request->exists('author_id')) {
            $posts = Post::where('user_id', $request->author_id);
            $author_id = $request->author_id; 
        }
        if ($request->exists('sort_by_date')) {
            //dd($request->sort_by_date);
            $posts = $posts->orderBy('published_at',$request->sort_by_date);
            $sort_by_date = $request->sort_by_date; 
        }

        $posts = $posts->paginate(4);
        //dd($posts);
        
        return view('layouts.homepage', compact(
            'posts','authors','author_id','sort_by_date'
        ));
    }

    // This function returns /homepage on / - url
    public function redirect() {
        return redirect('/homepage');
    }



    public function profile() {
        $users = User::count();
        $posts = Post::count();
        $user = Auth::user();

        return view('layouts.includes.profile_page_content_section', compact(
            'users',
            'posts',
            'user',
        ));

    }
}
