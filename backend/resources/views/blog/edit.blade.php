@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('編集') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    editです!
                    <form method="POST" action="{{ route('blog.update', ['id' => $blog->id ]) }}">
                    @csrf

                    タイトル<br>
                    <input type="text" name="title" value="{{ $blog->title }}">
                    <br>
                    鍛えた部位<br>
                    <select name="target_site" value="{{ $blog->target_site }}">
                    <option value="">選択してください</option>
                    <option value="胸" @if($blog->target_site === '胸' ) selected @endif>胸</option>
                    <option value="腕" @if($blog->target_site === '腕' ) selected @endif>腕</option>
                    <option value="肩" @if($blog->target_site === '肩' ) selected @endif>肩</option>
                    <option value="腹" @if($blog->target_site === '腹' ) selected @endif>腹</option>
                    <option value="背中" @if($blog->target_site === '背中' ) selected @endif>背中</option>
                    <option value="脚" @if($blog->target_site === '脚' ) selected @endif>脚</option>
                    <option value="その他" @if($blog->target_site === 'その他' ) selected @endif>その他</option>
                    </select>
                    <br>
                    内容<br>
                    <textarea name="content">{{ $blog->content }}</textarea>
                    <br>

                    <input class="btn btn-info" type="submit" value="更新">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
