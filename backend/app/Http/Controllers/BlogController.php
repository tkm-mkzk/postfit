<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
// use App\Models\User;
use App\Http\Requests\StoreBlog;
use Illuminate\Support\Facades\DB;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $blogs = Blog::all();

        // $blogs = Blog::All()
        // ->sortByDesc('created_at');

        $search = $request->input('search');

        // クエリビルダ
        // $blogs = DB::table('blogs')
        // ->select('id', 'title', 'target_site', 'content', 'created_at', 'user_id')
        // ->orderBy('created_at', 'desc')
        // ->paginate(10);

        // 検索フォーム
        $query = DB::table('blogs');
        // ->join('blogs', 'blog.id', '=', 'blogs.user_id')

        // もしキーワードがあったら
        if($search !== null){
            //全角スペースを半角に
            $search_split = mb_convert_kana($search, 's');

            //空白で区切る
            $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);

            //単語をループで回す
            foreach($search_split2 as $value)
            {
            $query->where('title', 'like', '%' .$value.'%')
            ->orWhere('target_site', 'like', '%' .$value.'%')
            ->orWhere('content', 'like', '%' .$value.'%')
            ->orWhere('created_at', 'like', '%' .$value.'%');
            }
        }

        $query->select('id', 'title', 'target_site', 'content', 'created_at', 'user_id');
        $query->orderBy('created_at', 'desc');
        $blogs = $query->paginate(20);

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
