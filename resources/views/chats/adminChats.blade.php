  
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="user-wrapper">
                    <ul class="users">
                    
                      
                        @foreach($users as $user)
                    
                            <li class="user" id="{{ $user->id }}">
                                {{--will show unread count notification--}}
                                @if($user->is_read)
                                    <span class="pending">{{ count($user->is_read) }}</span>
                                @endif

                                <div class="media">
                                    <div class="media-left">
                                    
                                    </div>

                                    <div class="media-body">
                                        <p class="name">{{ $user->name }}</p>
                                
                                    </div>
                                </div>
                            </li>
                          
                        @endforeach
                       
                       
                    </ul>
                </div>
            </div>

            <div class="col-md-8" id="messages">

            </div>
        </div>
    </div>
@endsection

<script>
  var receiver_id = '';
  var my_id = "{{ Auth::id() }}";
  $(document).ready(function () {
      // ajax setup form csrf token
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;
      var pusher = new Pusher('f215ae5857618ed02fd0', {
            cluster  : 'ap3',
            encrypted: true
        });

      //購読するチャンネルを指定
        var pusherChannel = pusher.subscribe('chat');

      channel.bind('chat_event', function (data) {
          // alert(JSON.stringify(data));
          if (my_id == data.send) {
              $('#' + data.receive).click();
          } else if (my_id == data.receive) {
              if (receiver_id == data.send) {
                  // if receiver is selected, reload the selected user ...
                  $('#' + data.send).click();
              } else {
                  // if receiver is not seleted, add notification for that user
                  var pending = parseInt($('#' + data.send).find('.pending').html());
                  if (pending) {
                      $('#' + data.send).find('.pending').html(pending + 1);
                  } else {
                      $('#' + data.send).append('<span class="pending">1</span>');
                  }
              }
          }
      });
      $('.user').click(function () {
          $('.user').removeClass('active');
          $(this).addClass('active');
          $(this).find('.pending').remove();
          receiver_id = $(this).attr('id');
          $.ajax({
              type: "get",
              url: "message/" + receiver_id, // need to create this route
              data: "",
              cache: false,
              success: function (data) {
                  $('#messages').html(data);
                  scrollToBottomFunc();
              }
          });
      });
      $(document).on('keyup', '.input-text input', function (e) {
          var message = $(this).val();
          // check if enter key is pressed and message is not null also receiver is selected
          if (e.keyCode == 13 && message != '' && receiver_id != '') {
              $(this).val(''); // while pressed enter text box will be empty
              var datastr = "receiver_id=" + receiver_id + "&message=" + message;
              $.ajax({
                  type: "post",
                  url: "message", // need to create this post route
                  data: datastr,
                  cache: false,
                  success: function (data) {
                  },
                  error: function (jqXHR, status, err) {
                  },
                  complete: function () {
                      scrollToBottomFunc();
                  }
              })
          }
      });
  });
  // make a function to scroll down auto
  function scrollToBottomFunc() {
      $('.message-wrapper').animate({
          scrollTop: $('.message-wrapper').get(0).scrollHeight
      }, 50);
  }
</script>