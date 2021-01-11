@if (Session::has('info'))
<div class="flex items-center justify-center mb-2">
    <div class="text-red-500" role="alert">
        {{ Session::get('info') }}
    </div>
    </div>
@endif