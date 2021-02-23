@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $blog->title }}
                    {{ $blog->target_site }}
                    {{ $blog->content }}
                    {{ $blog->created_at }}
                    {{ $blog->user->name }}

                    <form method="GET" action="{{ route('blog.edit', ['id' => $blog->id ]) }}">
                    @csrf

                    <input class="btn btn-info" type="submit" value="編集">
                    </form>

                    <form method="POST" action="{{ route('blog.destroy', ['id' => $blog->id ]) }}" id="delete_{{ $blog->id }}">
                    @csrf
                    <a href="#" class="btn btn-danger" data-id="{{ $blog->id }}" onclick="deletePost(this);">削除</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function deletePost(e) {
        'use strict';
        if (confirm('本当に削除していいですか?')) {
            document.getElementById('delete_' + e.dataset.id).submit();
        }
    }
</script>

@endsection
