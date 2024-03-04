<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation de l'adresse email</title>
    @vite('resources/css/app.css')
</head>
<body class="md:bg-etudes-blue">
    <div class="h-screen w-full grid place-items-center">
        <div class="max-w-2xl mx-auto w-full bg-white rounded-xl">
            <div class="text-center font-semibold text-xl mt-2">
                <a href="{{url('/')}}" class="cursor-pointer">
                    <button class="bg-etudes-orange px-2 py-1 rounded-xl text-white">
                        Accueil
                    </button>
                </a>
            </div>
            <div>
                <img src="{{asset('site/assets/login/mustConfirm.png')}}" class="h-96 m-auto cursor-pointer" alt="">
            </div>
        </div>
    </div>
</body>
</html>
