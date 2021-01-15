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
                     <td>
                <a href="{{ route('chats.received', ['receive' => Auth::user()->id ,'itemId' => $item->user->id]) }}">
                    <button type="button" class="btn btn-primary">Chat</button></a> 
               
                <input type="hidden" name="status">
                <button type="submit"> Chat</button>
             {{ $user->messages->where('receive',Auth::user()->id)->where('status',0)->count()   }} </td>
          
           
     
        @endforeach
        </tbody>
    </table>
 
</div>
 
@endsection