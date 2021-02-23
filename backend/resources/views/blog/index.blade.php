@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">タイトル</th>
                        <th scope="col">鍛えた部位</th>
                        <th scope="col">内容</th>
                        <th scope="col">投稿日時</th>
                        <th scope="col">投稿者</th>
                        <th scope="col">詳細</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                    <th>{{ $blog->title }}</th>
                    <td>{{ $blog->target_site }}</td>
                    <td>{{ $blog->content }}</td>
                    <td>{{ $blog->created_at }}</td>
                    <td>{{ $blog->user->name }}</td>
                    <td><a href="{{ route('blog.show', ['id' => $blog->id ]) }}">詳細</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
