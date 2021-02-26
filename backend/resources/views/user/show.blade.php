@extends('layouts.app')

@section('content')
@if( ( $user->id ) === ( Auth::user()->id ) )
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $user->name }}のページ</div>
        <div class="card-body">

          <table class="table">
            <thead>
                <tr>
                <th scope="col">名前</th>
                <th scope="col">メールアドレス</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
