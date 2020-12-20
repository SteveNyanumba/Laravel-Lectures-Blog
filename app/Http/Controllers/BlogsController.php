<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'image'=>'required|mimes:jpg,jpeg|max:3072',
            'category' => 'required',
            'content'=>'required'
        ]);

        $image = $request->file('image');
        if(isset($image)){
            $title = Str::slug($request->title);
            $date = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imagename = $title.'-'.$date.'.'.$ext;

            if(!file_exists('images/blogs')){
                mkdir('images/blogs');
            }

            $image->move('images/blogs');
        }else{
            $imagename = 'default.jpg';
        }

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;
        $blog->image = $imagename;
        $blog->user_id = auth()->user()->id;

        $blog->save();

        return redirect()->back()->with('successMsg','You have successfully created your blog post');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blogs.post')->with('blog',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('blogs.edit')->with('blog',$blog);
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
        $this->validate($request, [
            'title'=>'required',
            'image'=>'required|mimes:jpg,jpeg|max:3072',
            'category' => 'required',
            'content'=>'required'
        ]);

        $image = $request->file('image');
        if(isset($image)){
            $title = Str::slug($request->title);
            $date = Carbon::now()->toDateString();
            $ext = $image->getClientOriginalExtension();
            $imagename = $title.'-'.$date.'.'.$ext;

            if(!file_exists('images/blogs')){
                mkdir('images/blogs');
            }

            $image->move('images/blogs');
        }else{
            $imagename = 'default.jpg';
        }

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->category = $request->category;
        $blog->content = $request->content;
        $blog->image = $imagename;
        $blog->user_id = auth()->user()->id;

        $blog->save();

        return redirect()->back()->with('successMsg','You have successfully edited your blog post');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        unlink('images/blogs/'.$blog->image);
        $blog->delete();

        return redirect()->back()->with('successMsg','You have successfully Deleted your blog post');

    }
}
