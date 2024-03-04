@extends('site.app', [
    'title' => 'Le Bois sacré des PROS',
    'active' => 'subscription-description',
])

@section('content')
<div class="bg-gradient-to-r from-etudes-blue/[.2] to-etudes-orange/[.1]">
    <div class="py-10">
        <div class="grid md:grid-cols-2 divide-x divide-etudes-blue">
            <div>
                <div>
                    <img src="{{asset('site/assets/subscriptions/bois.png')}}" class="h-36 mx-auto animate__animated animate__backInDown" alt="">
                </div>
                <p class="text-xl leading-10 font-medium p-10 animate__animated animate__fadeIn">
                    <span class="text-etudes-blue font-bois text-5xl">Le Bois </span>
                    <span class="text-etudes-blue font-bold">Sacré des</span>
                    <span class="text-2xl text-white italic px-2 uppercase font-extrabold bg-etudes-orange ">Pros</span>
                    est une communauté de professionnels qui veut faire la différence, par le renforcement continu des capacités professionnelles.
                </p>
            </div>
            <div class="">
                <div class="">
                    <video src="{{asset('site/assets/subscriptions/spot.mp4')}}" class="h-80 md:h-96 mx-auto rounded-xl md:mt-2 animate__animated animate__fadeInRight" autoplay muted loop controls></video>
                </div>
            </div>
        </div>
        <div class="md:mt-10 grid md:grid-cols-2 md:ml-4">
            <div>
                <div class="bg-gradient-to-r from-white to-etudes-orange/[.1] border-4 p-1 md:p-4 rounded-xl border-etudes-orange">
                    <div class="text-center font-bold text-etudes-orange text-xl">Votre abonnement mensuel vous donne droit à</div>
                    <div>
                        <ul class="space-y-6 mx-4 md:mx-16 mt-6">
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">3 online Classroom de 2H chacune, avec des experts en direct.</span>
                            </li>
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">L’accès aux replays de ces 3 online Classroom à vie.</span>
                            </li>
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">L’accès à l’ensemble des replays, des online Classroom précédentes, durant votre période d’abonnement.</span>
                            </li>
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">Accès aux support de formation.</span>
                            </li>
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">Une remise de 10% à 30% sur l’ensemble des formations disponibles sur etudes.ci, des formations certifiantes, proposées par les meilleurs cabinets de formation nationaux et internationaux.</span>
                            </li>
                            <li class="flex justify-left items-start gap-2">
                                <i class="text-etudes-orange text-lg icofont-check-circled"></i>
                                <span class="pl-4 font-semibold text-etudes-blue">L’accès à toutes les fonctionnalités du module « MON CV EN LIGNE », pour réaliser un CV attractif en ligne en moins de 2 minutes.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center ml-1 md:ml-4 mt-8 md:mt-0">
                <div class="">
                    <div class="">
                        <span class="text-lg md:text-3xl font-bold">Intégrez le</span>
                        <span class="px-2 capitalize text-white bg-etudes-orange font-bold text-sm md:text-lg py-1">bois sacré des Pros, </span><br/>
                        <span class="font-bold text-sm md:text-lg">c'est choisir de passer à un autre niveau <br class="hidden md:block"/>  de sa carrière professionnelle.</span>
                    </div>
                    <div class="mt-8 md:text-3xl text-bois font-bold uppercase tracking-wider bg-etudes-orange text-white mx-auto italic py-3 text-center">
                       <del class="text-base pr-1 font-semibold">29.900 Fcfa</del> 14.900 Fcfa
                    </div>
                    <div class="mt-4 text-center">
                        <a href="{{route('subcription.pay')}}">
                            <button class="group">
                                <img src="{{asset('site/assets/subscriptions/button.png')}}" class="h-10 md:h-16 mx-auto shadow-xl rounded-xl group-hover:shadow-lg group-hover:shadow-etudes-orange duration-500 group-hover:scale-110" alt="">
                            </button>
                        </a>
                    </div>
                </div>
                <div class="border-b-4 border-etudes-orange rounded-l-xl">
                    <img src="{{asset('site/assets/subscriptions/man.png')}}" class="h-36 md:h-96" alt="">
                </div>
            </div>
        </div>

        <div class="mt-16">
            <div class="text-center text-etudes-blue font-semibold text-2xl">
                Les Online Classroom prochaines <i class="icofont-play-alt-3 text-etudes-orange text-2xl"></i>
            </div>
            <div class="max-w-6xl course-slide mx-auto">
                @foreach ($nextOnlineClasses as  $onlineClass)
                    <div class="mx-auto">
                        <a href="{{route('subcription.pay')}}">
                            <img src="{{$onlineClass->getFirstMediaUrl('onlineClass')}}" class="h-80 rounded-xl shadow-lg shadow-etudes-blue hover:scale-110 duration-500 hover:shadow-white" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{route('subcription.pay')}}">
                    <button class="group">
                        <img src="{{asset('site/assets/subscriptions/button.png')}}" class="h-16 mx-auto shadow-xl rounded-xl group-hover:shadow-lg group-hover:shadow-etudes-orange duration-500 group-hover:scale-110" alt="">
                    </button>
                </a>
            </div>
        </div>

        <div class="mt-16">
            <div class="text-center text-etudes-blue font-semibold text-2xl">
                Les Online Classroom disponibles en Replay <i class="icofont-play-alt-3 text-etudes-blue text-2xl"></i>
            </div>
            <div class="max-w-6xl course-slide mx-auto">
                @foreach ($replays as $replay)
                    <div class="mx-auto">
                        <a href="{{!is_null($subscription) ? $replay->detailsUrl() : route('subcription.pay')}}">
                            <img src="{{$replay->getFirstMediaUrl('courses')}}" class="h-56 rounded-xl shadow-lg shadow-etudes-blue hover:scale-110 duration-500 hover:shadow-white" alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-10 text-center">
                <a href="{{route('subcription.pay')}}">
                    <button class="group">
                        <img src="{{asset('site/assets/subscriptions/button.png')}}" class="h-16 mx-auto shadow-xl rounded-xl group-hover:shadow-lg group-hover:shadow-etudes-blue duration-500 group-hover:scale-110" alt="">
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
