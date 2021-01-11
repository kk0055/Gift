<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  @auth
 <span class="text-2xl font-medium mb-2 mr-3">{{ Auth::user()->name }}</span>
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
