<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>譲ります。上げます。</title>
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  
  <style>
    #menu-toggle:checked + #menu {
      display: block;
    }
</style>
</head>
<body class="antialiased bg-gray-200">
  <div id="app">
 
    <div class="container">
  
    <header class="lg:px-16 px-6 bg-white flex flex-wrap items-center lg:py-0 py-2">
      <div class="flex-1 flex justify-between items-center">
  
    </div>
  
     <label for="menu-toggle" class="pointer-cursor lg:hidden block"><svg class="fill-current text-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><title>menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path></svg></label>
    <input class="hidden" type="checkbox" id="menu-toggle" />
  
    <div class="hidden lg:flex lg:items-center lg:w-auto w-full" id="menu">
      <navbar></navbar>
         </div>
  
    </header>
    <items></items>
  </div>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>