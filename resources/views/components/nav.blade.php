<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  @auth

  
    @if (url()->current() !== url('/'))
      <a class="nav-link " href="{{ route('main') }}"> <span class=""><i class="fas fa-home-lg-alt text-black"></i></span></a>     
      @endif
     
  
 <div class="text-2xl  text-black ml-3 my-2" >  <a class="text-2xl mb-2 text-black" href="{{ route('users.items',Auth::user()->id) }}"> {{ Auth::user()->name }}</a>
  <a href="{{ route('chat.index',[Auth::user()->id]) }}"><i class="far fa-comment-dots"></i></a>
</div>
  @endauth
  <button class="navbar-toggler focus:outline-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
               
 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
      @if (url()->current() !== url('/'))
        <a class="nav-link " href="{{ route('main') }}"> <span class=""><i class="fas fa-home-lg-alt"></i></span></a>     
        @endif
       
      </li>
      @guest
      <li class="nav-item">
        @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
        <a class="nav-link" href="{{ route('login') }}">ログイン</a>
        @endif
    </li>
 
    <li class="nav-item">
      @if (url()->current() !== url('/login') && url()->current() !== url('/register'))
      <a class="nav-link" href="{{ route('register') }}">会員登録</a>
      @endif
  </li>
    @else
    {{-- <li class="nav-item">
      <a class="nav-link" href="#">  {{ Auth::user()->name }} </a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}"> ログアウト <span class="caret"></span></a>
</li>
@endguest
    </ul>
  </div>
</nav>
