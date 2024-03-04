@extends('site.app', [
    'title' => $event->name,
    'active' => 'events',
])

@section('content')
<div class="">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">{{$event->name}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('event.list')}}" class="line-clamp-1">
                            Liste des évènements professionnelles
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1">
                        {{$event->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-200">
        <div class="max-w-sm md:max-w-6xl py-8 mx-auto">
            <div class="mx-4 md:mx-0 md:flex justify-between items-start gap-10 bg-white rounded-lg p-4 shadow-xl">
                <div class="md:w-8/12">
                    <div class="uppercase text-2xl font-medium line-clamp-3">
                        {{$event->name}}
                    </div>
                    <div class="my-4 flex flex-wrap justify-left gap-4 md:gap-14 font-light">
                        <span>
                            <i class="icofont-ui-calendar text-etudes-orange"></i>
                            <span class="text-sm pl-2">{{$event->carbonHumanDate()}}</span>
                        </span>
                        <span>
                            <i class="icofont-wall-clock text-etudes-orange"></i>
                            <span class="text-sm pl-2">{{$event->carbonHumanHour()}}</span>
                        </span>
                        <span>
                            <i class="icofont-location-pin text-etudes-orange"></i>
                            <span class="text-sm pl-2">{{$event->place}}</span>
                        </span>
                    </div>
                    <div class='my-6 border-b border-b-etudes-blue'>
                        <img src="{{$event->getFirstMediaUrl('events')}}" class="w-full" alt="">
                    </div>
                    <div class="my-6">
                        <p class="text-justify">
                            {!! html_entity_decode($event->description) !!}
                        </p>
                    </div>
                </div>

                <div class="md:w-4/12 md:sticky md:top-28 mt-10 md:mt-24">
                    <div class="bg-etudes-blue p-4 rounded-lg">
                        <div class="flex justify-between items-center text-etudes-orange text-xl font-semibold" data-countdown="{{$event->start_date}}">
                        </div>
                        <div class="mt-4">
                            <a target="popup" onclick="window.open('https://www.google.com/calendar/render?action=TEMPLATE&text={{ str_replace('\'', ' ', $event -> name) }}&location={{ str_replace('\'', ' ', $event -> place) }}&dates={{ $event -> AgendaDate() }}&details={{Request::url()}}','popup','width=600,height=600'); return false;">
                                <button class="text-etudes-blue bg-etudes-orange w-full py-2 font-semibold text-xl rounded-lg hover:bg-white duration-300 hover:scale-105">
                                    + Google Agenda
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 border border-gray-300 rounded-lg py-4 px-6">
                        <ul>
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-ui-calendar text-etudes-orange"></i>
                                    Du
                                </div>
                                <span>{{$event->carbonHumanDate()}} - {{$event->carbonHumanHour()}} GMT</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-ui-calendar text-etudes-orange"></i>
                                    Au
                                </div>
                                <span>{{$event->carbonHumanEndDate()}} - {{$event->carbonHumanEndHour()}} GMT</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-map-pins text-etudes-orange"></i>
                                    Lieu
                                </div>
                                <span class="uppercase">{{$event->place}}</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-direction-sign text-etudes-orange"></i>
                                    Type de Lieu
                                </div>
                                <span class="uppercase">{{$event->place_type == 'present' ? 'Présentiel' : 'En ligne'}}</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-site-map text-etudes-orange"></i>
                                    Catégorie
                                </div>
                                <span class="uppercase">{{$event->Type->label}}</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-kiwibox text-etudes-orange"></i>
                                    Domaine
                                </div>
                                <span class="uppercase">{{$event->Domaines[0]->label}}</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div>
                                    <i class="icofont-price text-2xl text-etudes-orange"></i>
                                    Prix
                                </div>
                                <span class="text-xl font-semibold text-green-500">
                                    @if ($event->price)
                                        @if ($event->reduction)
                                            @money($event->price - ($event->price * ($event->reduction/100)))
                                        @else
                                            @money($event->price )
                                        @endif
                                    @else
                                        Gratuit
                                    @endif
                                </span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            @if ($event->price)
                                <div class="bg-etudes-orange text-white my-2 p-2 rounded-lg">
                                    <div class="font-semibold text-lg">Premium <i class="icofont-diamond"></i></div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xl font-semibold">@money($event->premium_price)</span>
                                        <del>
                                            @if ($event->price)
                                                @if ($event->reduction)
                                                    @money($event->price - ($event->price * ($event->reduction/100)))
                                                @else
                                                    @money($event->price )
                                                @endif
                                            @else
                                                Gratuit
                                            @endif
                                        </del>
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="text-center py-2">
                                @if ($event->price)
                                    @if ($event->reduction)
                                        @money($event->price - ($event->price * ($event->reduction/100)))
                                    @else
                                        @money($event->price )
                                    @endif
                                @else
                                    Gratuit
                                @endif
                            </div> --}}
                            <div class="text-center py-2">
                                @if (!is_null($event->personalized_link))
                                    <a href="{{$event->personalized_link}}" target="_blank">
                                        <button class="w-full text-white bg-etudes-blue rounded-lg py-2 duration-300 hover:bg-etudes-orange">S'incrire</button>
                                    </a>
                                @else
                                    <a href="{{route('payment', ['slug'=> $event->slug, 'type'=> 'event'])}}">
                                        <button class="w-full text-white bg-etudes-blue rounded-lg py-2 duration-300 hover:bg-etudes-orange">S'incrire</button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-4  md:mx-0 md:w-8/12 flex-none pb-3 md:pb-6 flex justify-left items-center gap-10 border-b mt-16 md:mt-10 border-gray-400">
                <div class="text-xl font-semibold">Partager : </div>
                <div class="flex justify-center items-center gap-4">
                    <a target="popup" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}','popup','width=600,height=600'); return false;">
                        <button class="text-xl px-2 p-1 rounded-lg bg-[#4267B2] hover:scale-150 duration-300">
                            <i class="icofont-facebook text-white"></i>
                        </button>
                    </a>
                    <a target="popup" onclick="window.open('https://www.linkedin.com/cws/share?url={{Request::url()}}','popup','width=600,height=600'); return false;">
                        <button class="text-xl px-2 p-1 rounded-lg bg-[#0077B5] hover:scale-150 duration-300">
                            <i class="icofont-linkedin text-white"></i>
                        </button>
                    </a>
                    <a target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{ $event->name}} {{Request::url()}}  @etudesci','popup','width=600,height=600'); return false;">
                        <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                            <i class="icofont-twitter text-white"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
