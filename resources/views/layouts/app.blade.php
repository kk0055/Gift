<!DOCTYPE html>
<html lang='ja' prefix='og: http://ogp.me/ns#'>
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta property="og:url" content="http://kasihkasih.net" />
<meta property="og:type" content=" ページの種類" />
<meta property="og:title" content="Kasih" />
<meta property="og:description" content="不要なものを載せましょう。無料で掲載できます。中古品が無料でもらえます。" />
<meta content='中古,あげます,譲ります,無料掲載,掲示板,kasih,カシー,フリーマーケット,無料,不用品処分' name='keywords' />
<meta property="og:site_name" content="Kasih" />
 
<meta property="og:image" content="https://image.freepik.com/free-vector/city-skyline-landmarks-illustration_23-2148810172.jpg" />

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V20FGW204K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V20FGW204K');
</script>
<!-- Global site tag (gtag.js) - Google Analytics -->

    {{-- Favicon --}}
    <link rel="icon" type="image/png" sizes="32x32"  href="{{ asset('favicon_io/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/favicon_io/site.webmanifest">
  {{--End Favicon --}}
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
     {{-- jquery --}}
      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    {{-- Fontawesome --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    {{-- Googleサチコ --}}
    <meta name="google-site-verification" content="IBlkgmZxcu786C156wF34ALLOhrS_JUJoBkUER_14ok" />
   {{-- CSS --}}
 <link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>

</style>
<title>Kasih</title>
</head>

<body class=" font-sans bg-gray-100">
    <div id="app">
        
      @include('components.nav')

        <main class="">

            @yield('content')

        </main>
    </div>
     
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src=“https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js”></script>
   
{{-- infinite-scroll --}}
{{-- @yield('scripts') --}}

{{-- chat --}}
<script src="{{ asset('/js/chat.js') }}"></script>
{{-- <script src="{{ asset('/js/chatadmin.js') }}"></script> --}}
{{-- Other --}}

<script src="{{ asset('/js/app.js') }}"></script>
<script src="{{ asset('/js/other.js') }}"></script>

{{--  --}}
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
        Pusher.logToConsole = false;
       
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
   
        if (e.keyCode == 13 && messages != '' && receiver_id != '') {
            $(this).val(''); 
            // var datastr = "receiver_id=" + receiver_id + "&message=" + message;
            
            $.ajax({
                type: "post",
                url: "message",
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


 </script>
</body>
</html>