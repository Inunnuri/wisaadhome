<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])<!-- untuk tailwinds -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> <!--untuk install alpine.js-->
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Halaman home</title>
</head>
<body class="h-full">
<div class="min-h-full ">
  <x-navbar></x-navbar>
  
  <x-header>{{$title}}</x-header>
    <main>
      <div class="mx-auto max-w-7xl py-6 px-8 md:px-8 lg:px-10">
        <!-- Your content -->
        {{$slot}}
      </div>
    </main>
  </div>
</body>
</html>