@extends('layouts.app')

@section('content')
<div class="container">
  @include('user.user')
  @include('user.tabs', ['hasBlogs' => true, 'hasLikes' => false])
  @foreach($blogs as $blog)
    @include('blog.card')
  @endforeach
</div>
@endsection
