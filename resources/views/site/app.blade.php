<!doctype html>
<html>
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-810KNX0NLR"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-810KNX0NLR');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@isset($title) {{$title}} @endisset - Etudes.ci</title>
    @vite(['resources/css/app.css', 'resources/css/slick.css'])
    <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">
    <link rel="icon" sizes="192x192" href="{{ asset('site/assets/favicon.png') }}">
</head>
<body>
    @include('site.includes.header')
        <div class="">
            @if (Auth::check())
                @if(!is_null(Auth::user()->Subscription) && !is_null(Auth::user()->Subscription->references) and $active != 'user-space')
                    <a href="{{route('subscritption.space')}}">
                        <button class="fixed right-4 md:right-10 md:text-xl z-50 bottom-10 bg-etudes-orange text-white p-2 md:p-4 rounded-lg md:rounded-xl shadow-xl shadow-black font-bold">Mon espace <i class="icofont-street-view"></i></button>
                    </a>
                @endif
            @endif
            @yield('content')
        </div>
    @vite(['resources/js/app.js', 'resources/js/slick.js'])
    {{-- tabs script --}}
    <script type="text/javascript" src="{{asset('site/assets/js/tabs.js')}}"></script>
    {{-- Accordeon script --}}
    <script type="text/javascript" src="{{asset('site/assets/js/accordion.js')}}"></script>
    <script type="text/javascript" src="{{asset('site/assets/js/search.js')}}"></script>

</body>
@if ($active != 'workSpace' && $active != 'resume')
    @include('site.includes.footer')
@endif
</html>
