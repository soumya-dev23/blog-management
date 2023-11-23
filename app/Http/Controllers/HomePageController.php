<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Post::findBySlug($slug);

        $post_id = $post->id;

        $comments = Post::find($post_id)->comments;

        //dd($comments);

        return view('pages.post_page', compact(
            'post','comments'
        ));

    }

    public function store(Request $request)
    {
        //dd($request);
        request()->validate([
            'content' => 'required',
        ]);
        Comment::create([
            'content'=> $request->content,
            'user_id'=> $request->user_id,
            'post_id'=> $request->post_id,
        ]);
        $ReturnData = array("ResponseCode" => 1, "ErrorDetails" => "");
        return response()->json($ReturnData);
 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
