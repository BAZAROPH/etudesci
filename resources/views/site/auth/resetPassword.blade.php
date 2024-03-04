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
            <div class="w-full">
                <div class="max-w-sm mx-auto">
                    <a href="{{route('home')}}" class="cursor-pointer">
                        <img src="{{asset('site/assets/white-logo.png')}}" class="h-16 mx-auto mb-4" alt="">
                    </a>
                </div>
                <div class="md:h-3/5 bg-white md:w-10/12 rounded-xl py-5 px-2 md:px-8 mx-2 md:mx-auto">
                    <div class="flex justify-center items-center max-w-sm mx-auto">
                        <div class="text-2xl font-semibold py-2 px-4 bg-green-600 text-white">Nouveau mot de passe</div>
                    </div>
                    <div class="w-full mx-auto mt-10 grid place-items-center">

                        <form action="{{route('save-new-password')}}" method="post" class="w-3/4" >
                            @csrf
                            @if($errors->any())
                                <div class="py-1 px-2 w-full bg-red-500/[.2] mb-4 rounded-base text-center text-sm font-semibold text-red-700 rounded-lg">
                                    @foreach ($errors->all() as $error )
                                        {{$error}}
                                    @endforeach
                                </div>
                            @endif
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="w-full">
                                <div class="text-lg text-etudes-blue required">Nouveau mot de passe</div>
                                <div class="mt-2">
                                    <input name="new_password" type="password" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                    <small  class="text-red-500 hidden">Vous devez renseigner votre adresse email !</small>
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="text-lg text-etudes-blue mt-6 required">Confirmez le mot de passe</div>
                                <div class="mt-2">
                                    <input  name="confirm_password" type="password" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                    <small class="text-red-500 hidden">Vous devez renseigner votre mot de passe !</small>
                                </div>
                            </div>

                            <div class="mt-6 mb-4 text-center">
                                <button class="bg-green-600 text-white rounded-md py-2 w-full font-semibold hover:scale-110 duration-300 hover:bg-etudes-blue">Enregistrer</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
