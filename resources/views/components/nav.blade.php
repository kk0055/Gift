@if (url()->current() !== url('/'))
@if (url()->current() !== url('/login') && url()->current() !== url('/register'))
<div class="topnav" id="myTopnav">
@auth


@if (url()->current() !== url('/'))
  <a href="{{ route('main') }}"> 
    <img src="/storage/image/kasih-removebg-preview.png" width="80" height="50" alt=""></a>     

  @endif
  <a href="{{ route('users.items',Auth::user()->id) }}" class="mt-3">Hello, {{ Auth::user()->name }}</a>
  <a  href="{{ route('chat.admin') }}" class="mt-3"><i class="far fa-comment-dots"></i></a>
  @endauth
  @guest
  @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
  <ul>
    @if (url()->current() !== url('/'))
    <a href="{{ route('main') }}"> 
      <img src="/storage/image/kasih-removebg-preview.png" width="80" height="50" alt=""></a>     
  
    @endif      
  <a href="{{ route('login') }}"class="right mt-3">ログイン</a>
  <a href="{{ route('register') }}" class="right mt-3">会員登録</a>

  @endif
  @else   <li>
  <a href="{{ route('logout') }}" class="right mt-3" > ログアウト </a></li>
  @endguest
  @auth
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fas fa-bullseye"></i>
  </a></ul>
  @endauth
</div>
@endif
@endif