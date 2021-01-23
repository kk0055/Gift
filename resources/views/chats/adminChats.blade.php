  
@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-4 ">
                <div class="user-wrapper " >
                    <ul class="users   ">
                    
                      
                        @foreach($users as $user)
                    @if(count($user))
                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
                                @if($user->unread)
                                    <span class="pending ">{{ $user->unread }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                    
                                    </div>

                                    <div class="media-body">
                                        <p class="name ml-3">{{ $user->name }}</p>
                                
                                    </div>
                                </div>
                            </li>
                          @else
                      <div>No message</div>
                          @endif
                        @endforeach
                       
                       
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection

