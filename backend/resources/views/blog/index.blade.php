@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('投稿一覧') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="GET" action="{{ route('blog.create') }}">
                    <button type="submit" class="btn btn-primary">
                        新規投稿
                    </button>
                    </form>

                    <form method="GET" action="{{ route('blog.index') }}" class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" name='search' type="search" placeholder="キーワード" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">検索する</button>
                    </form>

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">タイトル</th>
                        <th scope="col">鍛えた部位</th>
                        <th scope="col">内容</th>
                        <th scope="col">投稿日時</th>
                        {{-- <th scope="col">投稿者</th> --}}
                        <th scope="col">詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                    @if( ( $blog->user_id ) === ( Auth::user()->id ) )
                    <tr>
                    <th>{{ $blog->title }}</th>
                    <td>{{ $blog->target_site }}</td>
                    <td>{{ $blog->content }}</td>
                    <td>{{ $blog->created_at }}</td>
                    {{-- <td>{{ $blog->user->name }}</td> --}}
                    <td><a href="{{ route('blog.show', ['id' => $blog->id ]) }}">詳細</a></td>
                    </tr>
                    @endif
                    @endforeach
                    </tbody>
                    </table>

                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
