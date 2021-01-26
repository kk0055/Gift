<section class="showcase " style="min-height: 90vh;">
  <header>
    
    {{-- <h2 class="logo">Kasih</h2> --}}
    <div class="logo-image ">
   
    </div>

    <div class="toggle"></div>
  </header>
  <img
  class="main-img w-full h-full bg-center bg-cover "

  {{-- style='background-image: url("https://images.unsplash.com/photo-1609986826541-063f1aa74219?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDR8NnNNVmpUTFNrZVF8fGVufDB8fHw%3D0");background-position:right bottom' --}}
  style='background-image: url("image/bg.jpg");background-position: bottom '
>
  <div class="overlay"></div>
  <div class="text mt-5">
    
    <h3>We make a living by what we get.</h3>
    <h3>But we make a life by what we give.</h3>
   
    <a href="{{ route('item.create') }}" class="hbtn hb-fill-on mt-5 ">投稿する</a>
   
  </div>
 
 
  
</section>
<div class="menu none">
  <ul>
   @auth
       
 
    <li><a class="" href="{{ route('users.items',Auth::user()->id) }}"> {{ Auth::user()->name }}</a>
      </li>
      
    <li><a href="{{ route('chat.admin') }}"><i class="far fa-comment-dots"></i></a></li>

    <li> <a class="" href="{{ route('logout') }}"> ログアウト <span class="caret"></span></a>
    </li>
   
    @endauth
    @guest
    <li>   
      <a class="" href="{{ route('login') }}">ログイン</a>
    </li>
    <li>    
      <a class="" href="{{ route('register') }}">会員登録</a>
      </li>
      @endguest

  </ul>
</div>
</div>