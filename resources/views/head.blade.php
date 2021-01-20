<section class="showcase " style="min-height: 90vh;">
  <header>
    
    <h2 class="logo">Kasih</h2>
    <div class="toggle"></div>
  </header>
  <img
  class=" img w-full h-full bg-center bg-cover"
  style='background-image: url("https://images.unsplash.com/photo-1609986826541-063f1aa74219?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDR8NnNNVmpUTFNrZVF8fGVufDB8fHw%3D0");background-position:right bottom '
>
  <div class="overlay"></div>
  <div class="text">
    
    <h3>We make a living by what we get.</h3>
    <h3>But we make a life by what we give.</h3>
   
    <a href="#" class="hbtn hb-fill-on mt-5 ">投稿する</a>
   
  </div>
 
 
  
</section>
<div class="menu">
  <ul>
   
    <li><a class="" href="{{ route('users.items',Auth::user()->id) }}"> {{ Auth::user()->name }}</a>
      </li>
    <li><a href="{{ route('chat.admin') }}"><i class="far fa-comment-dots"></i></a></li>
    @guest
    <li>   @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
      <a class="" href="{{ route('login') }}">ログイン</a>
      @endif</li>
    <li>    @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
      <a class="" href="{{ route('register') }}">会員登録</a>
      @endif</li>
      @endguest
      <li> <a class="" href="{{ route('logout') }}"> ログアウト <span class="caret"></span></a>
        </li>
       
  </ul>
</div>
</div>