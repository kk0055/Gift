<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gift</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <style>
    #menu-toggle:checked + #menu {
      display: block;
    }
</style>
</head>
<body class=" bg-gray-200">
  <div id="app">
 
    <div class="flex justify-center">
     
{{-- @include('nav')   --}}

    <items></items>
  </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>