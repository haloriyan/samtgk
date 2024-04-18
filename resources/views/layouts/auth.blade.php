<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {!! json_encode(config('tailwind')) !!}
    </script>
</head>
<body>

<div class="fixed top-0 left-0 bottom-0 w-7/12 bg-cyan-500 mobile:hidden flex flex-col items-center justify-center text-white" style="background: url(/images/induk.jpg)"></div>
<div class="fixed top-0 left-0 bottom-0 w-7/12 mobile:hidden flex flex-col justify-end text-white p-10" style="background: linear-gradient(#ffffff00 10%, rgba(6, 182, 212, 1) 90%);">
    <h1 class="text-3xl font-black">{{ env('APP_NAME') }}</h1>
</div>
<div class="fixed top-0 right-0 bottom-0 w-5/12 flex flex-col items-center justify-center mobile:w-full">
    <img src="{{ asset('images/logo.png') }}" alt="Logo samsat" class="w-6/12 aspect-video mb-4">
    @yield('content')
</div>

@yield('javascript')

</body>
</html>