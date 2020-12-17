<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Blog::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'image'=>'mimes:png,jpg,jpeg',
            'category'=>'required',
            'content'=>'required'
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            $date = Carbon::now()->toDateString();
            $title = Str::slug($request->title);
            $ext = $image->getClientOriginalExtension();

            $imagename = $date.'-'.$title.'.'.$ext;
            if(!file_exists('images/blogs')){
                mkdir('images/blogs');
            }
            $image->move('images/blogs', $imagename);
        }else{
            $imagename = 'default.jpg';
        }

        $blog = new Blog();
        $blog->user_id = auth()->user()->id;
        $blog->image = $imagename;
        $blog->category = $request->category;
        $blog->title = $request->title;
        $blog->content = $request->content;

        $blog->save();
        return response('Successfully Created a blogpost', 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Blog::find($id);
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
