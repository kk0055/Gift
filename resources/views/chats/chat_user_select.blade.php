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
            @if (!null == $user->messages->where('receive',Auth::user()->id)->where('status',0)->count() )
        <tr>
            <th>{{$loop->iteration}}</th>
            {{-- @if ($user->name == ) --}}
            <td>{{$user->name}}</td>   
            {{-- @endif --}}
           
                     <td>
                <a href="{{ route('chats.users', ['receive' => $user->id ,'itemId' => $user->id]) }}">
                      {{-- <a href="{{ route('chats.users',['receive' => $item->user->id ,'itemId'=> $item->id ] ) }}"  --}}
                    <button type="button" class="btn btn-primary">Chat</button></a> 
               
                <input type="hidden" name="status">
                <button type="submit"> Chat</button>
             {{ $user->messages->where('receive',Auth::user()->id)->where('status',0)->count()   }} </td>
            
             @endif
             @endforeach
    
       
        </tbody>
       
    </table>
 
</div>
 
@endsection