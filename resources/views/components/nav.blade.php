<nav class="navbar navbar-expand-lg navbar-light bg-white ">
  @auth
 <span class="text-2xl font-medium mb-2">{{ Auth::user()->name }}</span>
  @endauth
  <button class="navbar-toggler focus:outline-none" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
               
 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('main') }}"> <span class="">ホーム</span></a>
      </li>
      @guest
      <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}">{{ __('register') }}</a>
  </li>
    @else
    {{-- <li class="nav-item">
      <a class="nav-link" href="#">  {{ Auth::user()->name }} </a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}">    {{ __('Logout') }} <span class="caret"></span></a>
</li>
@endguest
    </ul>
  </div>
</nav>
