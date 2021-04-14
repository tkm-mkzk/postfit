@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('プロフィール編集') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.edit') }}" class="p-5" enctype="multipart/form-data">
                    @csrf

                    {{-- アバター画像 --}}
                    <span class="avatar-form image-picker">
                        <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                        <label for="avatar" class="d-inline-block">
                            @if (!empty($user->avatar_file_name))
                                <img src="/storage/avatars/{{$user->avatar_file_name}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @else
                                <img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                            @endif
                        </label>
                    </span>

                    <div class="form-group mt-3">
                        <label for="name">名前</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-secondary">
                            保存
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
