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
<body class="">
    <div class="grid align-items-center">
        <img src="{{asset('site/assets/blue-logo.png')}}" class="h-20 mx-auto mt-10" alt="">
        <div class="max-w-xl mx-auto  w-full mt-6">
            @if($error == false)
                <div class="text-center text-white font-bold  p-4 bg-green-600 rounded-lg">
                    Félicitations, votre paiement pour {{$type ==' certification' ? 'la formation' : 'l\'évènement'}} {{$product['label']}} a été effectué avec succès.
                </div>
                <div class="text-center mt-8 text-green-600">
                    <i class="icofont-check-circled text-9xl"></i>
                </div>
                <div class="text-center font-bold text-etudes-blue mt-6">
                    Votre reçu de paiement vous a été envoyé par email.
                </div>
                <div class="text-center mt-1 font-light text-etudes-blue">
                    {{$type ==' certification' ? 'Le cabinet de formation' : 'L\'organisateur'}} {{$product['author']}} Vous contactera.
                </div>
                <div class="text-center mt-10 p-2 rounded-lg text-white font-bold bg-etudes-blue"> Merci de faire confiance à Etudes.ci.</div>
            @else
                <div class="mt-4">
                    <div class="max-w-md mx-auto text-center text-xl font-bold text-red-600 italic">Malheureusement votre paiement a échoué veuillez le réessayer !</div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{route('home')}}">
                        <button class="text-white px-4 py-2 bg-etudes-orange rounded-lg shadow shadow-4xl hover:bg-etudes-blue hover:scale-110 duration-300 transition-all ease-in-out font-bold">Accueil</button>
                    </a>
                </div>
                <div class="mt-20 text-center  text-sm max-w-xl mx-auto font-light text-etudes-blue">
                    Pour toute information ou préoccupations, veuillez nous contacter au <br/> <span class="font-bold">+225 0700773304 / 2724309780 / commercial@etudesci</span>
                </div>
            @endif
        </div>
    </div>
    @vite(['resources/js/app.js', 'resources/js/slick.js'])
</body>
</html>
