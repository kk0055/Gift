@if (Session::has('info'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('info') }}
    </div>
@endif

@if (Session::has('register'))
    <div class="alert alert-info" role="alert">
        {{ Session::get('register') }}
    </div>
@endif