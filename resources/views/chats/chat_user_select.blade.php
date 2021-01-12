@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
 
        </div>
    </div>
 
    {{--  チャット可能ユーザ一覧  --}}
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
        <tr>
            <th>{{$loop->iteration}}</th>
            <td>{{$user->name}}</td>
            <td><a href="{{ route('chats.user', $user->id) }}"><button type="button" class="btn btn-primary">Chat</button></a>  
                {{-- @if($user->messages->count())
                {{ $user->messages->count() }}</td>
                @endif --}}
        </tr>
        @endforeach
        </tbody>
    </table>
 
</div>
 
@endsection