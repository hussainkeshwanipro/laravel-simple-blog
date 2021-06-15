<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('blogs')->get();
        return view('admin.blog.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'desc'=>'required',
            'image'=>'required|image|max:2048'
        ]);
        $imageName = '';
        if($request->image)
        {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move('upload', $imageName);
        }
        $data = $request->all();
        $blog = new Blog();
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->image = $imageName;
        $blog->save();
        return redirect('blog')->with('success', 'data uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Blog::find($id);
        return view('admin.blog.edit', compact('data'));
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
        $blog = Blog::find($id);
        $imageName = '';
        if($request->image)
        {
            unlink('upload/'.$blog->image);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move('upload', $imageName);
            $blog->image = $imageName;
        }
        $data = $request->all();
        $blog->title = $data['title'];
        $blog->desc = $data['desc'];
        $blog->save();
        return redirect('blog')->with('success', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Blog::find($id);
        unlink('upload/'.$movie->image);
        $movie->delete();
        return redirect('blog')->with('success', 'data deleted successfully');
    }
}
