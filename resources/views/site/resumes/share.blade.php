<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CV {{$resume->data['personal']['first_name']}} - {{$resume->data['personal']['last_name']}}</title>
    @vite(['resources/css/app.css', 'resources/css/slick.css'])
    <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">
    <link rel="icon" sizes="192x192" href="{{ asset('site/assets/favicon.png') }}">
</head>
<body style="background-image: url({{asset('site/assets/avis.jpg')}});background-size:cover;background-repeat: no-repeat;background-attachment: fixed;">

    <div class="max-w-2xl mx-auto my-2">
        <div id="app" class="border">

        </div>
        <div class="mt-2">
            <div class="text-xs text-white font-medium text-center">Réalisé avec Etudes.ci </div>
            <div class="text-xs text-white font-medium text-center mt-1">
                Concevez votre CV attractif en ligne sur <a href="www.etudes.ci/resumes" target="_blank" class="font-bold">www.etudes.ci</a>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var ROOT_URL = "{{ route('home') }}";
        var APP_NAME = "{{ config('app.name', 'Etudes.ci') }}";
        var MODEL = "{{$resume['data']['model']}}"
    </script>
    @vite(['resources/js/app.js'])
    @vite('resources/js/resumes/App.jsx')
</body>
</html>
