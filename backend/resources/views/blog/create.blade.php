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

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('blog.store') }}">
                    @csrf
                    タイトル<br>
                    <input type="text" name="title">
                    <br>
                    鍛えた部位<br>
                    <select name="target_site">
                    <option value="">選択してください</option>
                    <option value="胸">胸</option>
                    <option value="腕">腕</option>
                    <option value="肩">肩</option>
                    <option value="腹">腹</option>
                    <option value="背中">背中</option>
                    <option value="脚">脚</option>
                    <option value="その他">その他</option>
                    </select>
                    <br>
                    内容<br>
                    <textarea name="content"></textarea>
                    <br>
                    <input class="btn btn-info" type="submit" value="投稿する">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
