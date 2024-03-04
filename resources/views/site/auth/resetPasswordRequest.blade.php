<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - Etudes.ci</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="md:grid md:grid-cols-2">
        <div class="hidden md:block">
            <img src="{{asset('site/assets/login/cover.png')}}" alt="">
        </div>
        <div class="h-screen pt-10 md:pt-0 md:grid md:place-items-center bg-etudes-blue">
            <div class="md:h-2/5 bg-white md:w-10/12 rounded-xl py-5 px-8 mx-2 md:mx-auto mt-32 md:mt-0">
                <div class="text-center text-xl font-bold text-etudes-blue">Réinitialiser mon mot de passe</div>
                <div class="max-w-sm mx-auto mt-10">
                    <form action="{{route('send-reset-password')}}" method="post">
                        @csrf
                        @if($errors->any())
                            <div class="py-1 px-2 w-full bg-red-500/[.2] mb-4 rounded-base text-center text-sm font-semibold text-red-700 rounded-lg">
                                @foreach ($errors->all() as $error )
                                    {{$error}}
                                @endforeach
                            </div>
                        @endif
                        <div class="text-lg text-etudes-blue required text-center">Votre adresse email</div>
                        <div class="mt-2">
                            <input id='login-email' name="email" type="email" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                            <small id="login-email-error" class="text-red-500 hidden">Vous devez renseigner votre adresse email !</small>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="text-white bg-etudes-blue px-2 py-1 rounded-lg hover:scale-110 duration-300 hover:font-semibold">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
