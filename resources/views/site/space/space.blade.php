@extends('site.app', [
    'title' => 'Mon Espace',
    'active'=> 'user-space',
])

@section('content')
<div class="bg-gradient-to-r from-etudes-blue/[.2] to-etudes-orange/[.1] pb-6">
    <div class="border-b pb-4 border-etudes-blue bg-gradient-to-r from-etudes-blue/[.4] to-etudes-orange/[.2] pt-5 relative">
        @if ($actif)
            <div class="absolute right-0 pr-4">
                <span class="font-bold text-white md:text-etudes-blue">Abonnement: <span class="pl-4 text-base font-normal italic">Actif jusqu'au</span> <span class="px-1 text-white bg-etudes-orange italic">{{$subscription->endDate()}} à {{$subscription->endHour()}}</span></span>
                <div class="mt-4 text-right">
                    <a href="{{route('subcription.pay')}}">
                        <button class="text-xs md:text-base text-white font-medium  bg-etudes-blue p-2 rounded-lg hover:w-full w-3/5 duration-300 hover:bg-etudes-orange hover:font-semibold">Prolonger mon abonnement</button>
                    </a>
                </div>
            </div>

        @else
            <div class="absolute right-0 pr-4">
                <span class="font-bold text-white md:text-etudes-blue">Abonnement: <span class="pl-4 text-base font-normal italic">Inactif depuis le</span> <span class="px-1 text-white bg-red-600 italic">{{$subscription->endDate()}} à {{$subscription->endHour()}}</span></span>
                <div class="mt-4 text-right">
                    <a href="{{route('subcription.pay')}}">
                        <button class="text-xs md:text-base text-white font-medium  bg-etudes-orange p-2 rounded-lg hover:w-full w-3/5 duration-300 hover:bg-etudes-blue hover:font-semibold">Renouveler mon abonnement</button>
                    </a>
                </div>
            </div>

        @endif
        <img src="{{asset('site/assets/subscriptions/bois.png')}}" class="h-24 mx-auto" alt="">
        <div class="text-center text-4xl font-bois text-etudes-blue tracking-widest mt-4">
            Bienvenue dans votre espace sacré
        </div>
    </div>
    <div class="grid grid-cols-3 ">
        <div class="col-span-3">
            <div class="px-4 py-6">
                <div class="text-lg md:text-2xl text-etudes-orange font-medium ">Prochaines Onlines Classroom <i class="icofont-ui-play pl-2"></i></div>
                <div class="max-w-6xl course-slide mx-auto flex">
                    @foreach ($nextOnlineClasses as $nextOnlineClass)
                        <div class="mx-auto">
                            <a href="{{route('onlineClass.open', $nextOnlineClass->slug)}}">
                                <img src="{{$nextOnlineClass->getFirstMediaUrl('onlineClass')}}" class="h-80 w-full rounded-xl shadow-lg shadow-etudes-orange hover:scale-110 duration-500 hover:shadow-white" alt="">
                                {{-- <div class="block">
                                    <div class="flex items-center text-etudes-orange text-xl font-semibold bg-etudes-blue mt-2 p-2 rounded-lg" data-countdown="{{$nextOnlineClass->date.' '.$nextOnlineClass->hour}}">
                                </div> --}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="px-4 py-6">
                <div class="text-lg md:text-2xl text-etudes-blue font-medium">Mes Replays disponibles <i class="icofont-play-pause pl-2"></i></div>
                <div class="max-w-6xl course-slide mx-auto">
                    @foreach ($replays as $replay)
                        <div class="mx-auto">
                            <a href="{{$replay->detailsUrl()}}">
                                <img src="{{$replay->getFirstMediaUrl('courses')}}" class="h-56 rounded-xl shadow-lg shadow-etudes-blue hover:scale-110 duration-500 hover:shadow-white" alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="px-10 md:px-20 pb-4 md:pb-0 flex flex-wrap justify-between items-center bg-etudes-blue">
                <div class="">
                    <div class="p-2">
                        <div class="mt-4">
                            <img src="{{asset('site/assets/subscriptions/cv.jpeg')}}" class="h-64 rounded mx-auto" alt="">
                        </div>
                    </div>
               </div>
               <div class="">
                    <video src="{{asset('site/assets/subscriptions/spot.mp4')}}" class="h-64" autoplay muted loop controls></video>
                </div>
               <div>
                    <ul class="text-center mt-2 font-semibold text-etudes-blue">
                        <li class=""><span class="text-white px-1 uppercase italic">Changez les couleurs</span></li>
                        <li class=""><span class="text-white px-1 uppercase italic">Accédez à plus de modeles</span></li>
                        <li class=""><span class="text-white px-1 uppercase italic">Partagez votre CV avec un lien</span></li>
                    <div class="text-center mt-2">
                        <button class="w-1/2 py-2 bg-etudes-orange text-white rounded-lg hover:w-2/3 duration-300 hover:font-bold">
                            Espace mon CV
                        </button>
                    </div>
               </div>
            </div>

            <div class="md:px-20">
                <div class="mt-6">
                    <div class="text-2xl text-etudes-blue font-medium">Quelques formations <i class="icofont-learn pl-2"></i></div>
                    <div class="course-slide">
                        @foreach ($certifications as $certification)
                            <div class="shadow-xl border rounded-xl h-full">
                                <div class="w-full">
                                    <a href="{{$certification->detailsUrl()}}">
                                        <img src="{{$certification->getFirstMediaUrl('certifications')}}" class="h-96 w-full " alt="">
                                    </a>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-center text-gray-500">
                                        <div class="gap-4 flex items-center">
                                            <i class="icofont-ui-calendar text-etudes-orange"></i>
                                            <span>{{$certification->carbonHumanDate()}}</span>
                                        </div>
                                        <div>
                                            <i class="icofont-location-pin text-etudes-blue"></i>
                                            @if ($certification->location_type == 'online')
                                                En ligne
                                            @else
                                                En présentiel
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-1">
                                        <a href="{{$certification->detailsUrl()}}">
                                            {{$certification->title}}
                                        </a>
                                    </div>
                                    <div class=" flex justify-left gap-5 items-center">
                                        <img src="{{asset('site/assets/test/certificats_1662043814.png')}}" class="h-14 w-14 rounded-full  border border-etudes-blue" alt="">
                                        <span class="capitalize text-etudes-blue tracking-widest">{{$certification->Office->name}}</span>
                                    </div>
                                </div>
                                <div class="border-gray-300 border-t p-4 flex justify-between items-center">
                                    <span class="text-etudes-orange font-bold text-xl">
                                        @money($certification->premium_price) <i class="icofont-star"></i>
                                    </span>
                                    <del class="text-gray-500 font-bold text-xl">
                                        @if ($certification->reduction)
                                            @money($certification->price - ($certification->price * ($certification->reduction/100)))
                                        @else
                                            @money($certification->price )
                                        @endif
                                    </del>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="md:px-20">
                <div class="mt-6">
                    <div class="text-2xl text-etudes-blue font-medium">Quelques évènements <i class="icofont-learn pl-2"></i></div>
                    <div class="course-slide">
                        @foreach ($events as $event)
                        <div class="shadow-xl border rounded-xl">
                            <div class="w-full">
                                <a href="{{$event->detailsUrl()}}">
                                    <img src="{{$event->getFirstMediaUrl('events')}}" class="h-80 w-full rounded-t-xl" alt="">
                                </a>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-left items-center gap-2 text-gray-500 text-sm">
                                    <div class=" gap-2 flex items-center">
                                        <i class="icofont-ui-calendar text-etudes-orange"></i>
                                        <span>{{$event->carbonHumanDate()}}</span>
                                    </div>
                                    <div>|</div>
                                    <div>
                                        <i class="icofont-stopwatch text-etudes-blue"></i>
                                        <span>{{$event->carbonHumanHour()}} GMT</span>
                                    </div>
                                </div>
                                <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-1">
                                    {{$event->name}}
                                </div>
                            </div>
                            <div class="border-gray-300 border-t p-4">
                                <i class="icofont-location-arrow text-etudes-blue"></i>
                                {{$event->place}}
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>

        </div>
        {{-- <div class="border-l-2 border-etudes-blue">
           <div class="border-b-2 border-etudes-blue pb-4">
                <div class="text-center text-lg font-bold bg-etudes-blue border-b-2 border-dashed border-etudes-blue p-2 border-b pb-4 border-etudes-blue text-white">
                    CV en ligne avec Etudes.ci
                </div>
                <div class="p-2">
                    <div class="text-center italic text-etudes-blue">Concevez votre cv en 2 minutes</div>
                    <ul class="text-center mt-2 font-semibold text-etudes-blue">
                        <li class=""><span class="text-white bg-etudes-orange px-1 uppercase italic">Changez les couleurs</span></li>
                        <li class=""><span class="text-white bg-etudes-orange px-1 uppercase italic">Accédez à plus de modeles</span></li>
                        <li class=""><span class="text-white bg-etudes-orange px-1 uppercase italic">Partagez votre CV avec un lien</span></li>
                    </ul>
                    <div class="mt-4">
                        <img src="{{asset('site/assets/subscriptions/cv.jpeg')}}" class="h-64 rounded mx-auto" alt="">
                    </div>
                    <div class="text-center mt-2">
                        <button class="w-1/2 py-2 bg-etudes-blue text-white rounded-lg hover:w-2/3 duration-300 hover:font-bold">
                            Espace mon CV
                        </button>
                    </div>
                </div>
           </div>

           <div class="mt-2">
                <div class="text-center text-xl font-semibold text-etudes-blue pt-2">Quelques formations</div>
                <div class="subscription-certifications-slide">
                    @foreach ($certifications as $certification)
                        <div class="shadow-xl border rounded-xl h-full">
                            <div class="w-full">
                                <a href="{{$certification->detailsUrl()}}">
                                    <img src="{{$certification->getFirstMediaUrl('certifications')}}" class="h-96 w-full " alt="">
                                </a>
                            </div>
                            <div class="p-4">
                                <div class="flex justify-between items-center text-gray-500">
                                    <div class="gap-4 flex items-center">
                                        <i class="icofont-ui-calendar text-etudes-orange"></i>
                                        <span>{{$certification->carbonHumanDate()}}</span>
                                    </div>
                                    <div>
                                        <i class="icofont-location-pin text-etudes-blue"></i>
                                        @if ($certification->location_type == 'online')
                                            En ligne
                                        @else
                                            En présentiel
                                        @endif
                                    </div>
                                </div>
                                <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-1">
                                    <a href="{{$certification->detailsUrl()}}">
                                        {{$certification->title}}
                                    </a>
                                </div>
                                <div class=" flex justify-left gap-5 items-center">
                                    <img src="{{asset('site/assets/test/certificats_1662043814.png')}}" class="h-14 w-14 rounded-full  border border-etudes-blue" alt="">
                                    <span class="capitalize text-etudes-blue tracking-widest">{{$certification->Office->name}}</span>
                                </div>
                            </div>
                            <div class="border-gray-300 border-t p-4 flex justify-between items-center">
                                <span class="text-etudes-orange font-bold text-xl">
                                    @money($certification->premium_price) <i class="icofont-star"></i>
                                </span>
                                <del class="text-gray-500 font-bold text-xl">
                                    @if ($certification->reduction)
                                        @money($certification->price - ($certification->price * ($certification->reduction/100)))
                                    @else
                                        @money($certification->price )
                                    @endif
                                </del>
                            </div>
                        </div>
                    @endforeach
                </div>
           </div>
        </div> --}}
    </div>
</div>
@endsection
