@if (url()->current() !== url('/'))
@auth
<div class="topnav" id="myTopnav">

@if (url()->current() !== url('/'))
  <a href="{{ route('main') }}"> 
    <img src="/storage/image/kasih-removebg-preview.png" width="80" height="50" alt=""></a>     

  @endif
  <a href="{{ route('users.items',Auth::user()->id) }}"> {{ Auth::user()->name }}</a>
  <a  href="{{ route('chat.admin') }}"><i class="far fa-comment-dots"></i></a>
  @endauth
  @guest
  @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
  <ul>
 
  <a href="{{ route('login') }}"class="right">ログイン</a>
  <a href="{{ route('register') }}" class="right">会員登録</a>

  @endif
  @else   <li>
  <a href="{{ route('logout') }}" class="right" > ログアウト </a></li>
  @endguest
  @auth
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fas fa-bullseye"></i>
  </a></ul>
  @endauth
</div>
@endif