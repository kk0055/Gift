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
    
      var channel = pusher.subscribe('chat');
      let appendText;
      channel.bind('chat_event', function (data) {
        // alert(JSON.stringify(data));
        if (my_id == data.send) {
          
            $('#' + data.receive).click();
        } else if (my_id == data.receive) {
            if (receiver_id == data.send) {
                
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
                // メッセージを表示
      $("#admin").append(appendText);
    });
  
    
    $('.user').click(function () {
        $('.user').removeClass('active');
        $(this).addClass('active');
        $(this).find('.pending').remove();
        receiver_id = $(this).attr('id');
        $.ajax({
            type: "get",
            url: "message/" + receiver_id, 
            data: "",
            cache: false,
            success: function (data) {
                $('#messages').html(data);
                scrollToBottomFunc();
            }
        });
    });

    
    $(document).on('keyup', '.input-text input', function (e) {
        var messages = $(this).val();
        console.log($('input[name="message"]').val())
        // check if enter key is pressed and message is not null also receiver is selected
        if (e.keyCode == 13 && messages != '' && receiver_id != '') {
            $(this).val(''); // while pressed enter text box will be empty
            // var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            
            $.ajax({
                type: "post",
                url: "message", // need to create this post route
                data:  {
                message : messages,
                send : $('input[name="send"]').val(),
                receive :   receiver_id,
                item_id : $('input[name="item_id"]').val(),
                 },
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