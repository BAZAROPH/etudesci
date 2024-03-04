<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Félicitation - Etudes.ci</title>
    @vite(['resources/css/app.css', 'resources/css/slick.css'])
    <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">
    <link rel="icon" sizes="192x192" href="{{ asset('site/assets/favicon.png') }}">
</head>
<body class="bg-gradient-to-r from-etudes-blue/[.5] to-etudes-orange/[.8]">
    <div class="grid align-items-center">
        <img src="{{asset('site/assets/subscriptions/bois.png')}}" class="h-40 mx-auto mt-10" alt="">

        @if($error == true)
            <div class="mt-4">
                <div class="max-w-md mx-auto text-center text-xl font-bold text-red-600 italic">Malheureusement votre paiement a échoué veuillez le réessayer !</div>
            </div>
        @else
            <div class="mt-4">
                <div class="max-w-md mx-auto text-center text-xl font-bold text-white italic">Félicitations pour votre abonnement mensuel au Bois Sacré des Pros. </div>
            </div>
            <div class="max-w-xl mx-auto bg-white p-3 rounded-lg w-full mt-6">
                <div class="text-center font-bold text-etudes-blue">
                    Votre abonnement vous donne droit à
                </div>
                <div>
                    <ul class="space-y-2 mx-4 md:mx-16 mt-6">
                        <li class="flex justify-left items-center gap-2">
                            <i class="text-etudes-orange text-sm icofont-check-circled"></i>
                            <span class="pl-4 font-light text-etudes-blue">3 online Classroom de 2H chacune, avec des experts en direct.</span>
                        </li>
                        <li class="flex justify-left items-center gap-2">
                            <i class="text-etudes-orange text-sm icofont-check-circled"></i>
                            <span class="pl-4 font-light text-etudes-blue">Un accès à l'ensemble des replays, durant votre période d'abonnement.</span>
                        </li>
                        <li class="flex justify-left items-center gap-2">
                            <i class="text-etudes-orange text-sm icofont-check-circled"></i>
                            <span class="pl-4 font-light text-etudes-blue">Une remise 10 à 30% sur les formations enregistrées sur la plateforme Etudes.ci</span>
                        </li>
                        <li class="flex justify-left items-center gap-2">
                            <i class="text-etudes-orange text-sm icofont-check-circled"></i>
                            <span class="pl-4 font-light text-etudes-blue">Un accès à toutes les fonctionnalités du module MON CV en ligne.</span>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <div class="text-center mt-4">
        @if($error == true)
            <a href="{{route('subcription.pay')}}">
                <button class="text-white px-4 py-2 bg-etudes-orange rounded-lg shadow shadow-4xl hover:bg-etudes-blue hover:scale-110 duration-300 transition-all ease-in-out">Réessayer mon Paiement <i class="icofont-user-alt-5"></i></button>
            </a>
        @else
            <a href="">
                <button class="text-white px-4 py-2 bg-etudes-orange rounded-lg shadow shadow-4xl hover:bg-etudes-blue hover:scale-110 duration-300 transition-all ease-in-out">Mon Espace <i class="icofont-user-alt-5"></i></button>
            </a>
        @endif
    </div>
    <div class="mt-10 text-center  text-sm max-w-xl mx-auto font-light text-white">
        Pour toute information ou préoccupations, veuillez nous contacter au <br/> <span class="font-bold">+225 0700773304 / 2724309780 / commercial@etudesci</span>
    </div>
    @vite(['resources/js/app.js', 'resources/js/slick.js'])
</body>
</html>
