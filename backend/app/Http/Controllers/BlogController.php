<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\StoreBlog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $word = mb_convert_kana($request->input('search'), 's');
        $words = explode(' ', $word);

        $blogs = Blog::query()
            ->where('user_id', $request->user()->id)
            ->when(count($words), function ($query) use ($words) {
                $query->where(function($query) use ($words) {
                    foreach ($words as $word) {
                        $query->where('title', 'like', '%' . $word . '%')
                            ->orWhere('target_site', 'like', '%' . $word . '%')
                            ->orWhere('content', 'like', '%' . $word . '%')
                            ->orWhere('created_at', 'like', '%' . $word . '%');
                    }
                });
            })
            ->latest()
            ->paginate(20);

        return view('blog.index', compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlog $request)
    {
        $blog = new Blog;

        $blog->title = $request->input('title');
        $blog->target_site = $request->input('target_site');
        $blog->content = $request->input('content');
        $blog->user_id = $request->user()->id;

        $blog->save();

        return redirect('blog/index');
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

        return view('blog.show',
        compact('blog'));
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

        return view('blog.edit', compact('blog'));
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


        $blog->title = $request->input('title');
        $blog->target_site = $request->input('target_site');
        $blog->content = $request->input('content');
        $blog->user_id = $request->user()->id;

        $blog->save();

        return redirect('blog/index');
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
        $blog->delete();

        return redirect('blog/index');
    }
}
