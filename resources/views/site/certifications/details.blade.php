@extends('site.app', [
    'title' => $certification->title,
    'active' => 'certifications',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">{{$certification->title}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('certification.list')}}" class="line-clamp-1">
                            Liste des certifications
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1">
                        {{$certification->title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="mx-4 md:mx-0 md:flex justify-between items-start gap-10">
            <div class="md:w-8/12">
                <div class="my-8 flex flex-wrap items-center justify-between space-y-6 md:space-y-0">
                    <div class="flex items-center justify-left gap-4">
                        <img src="{{$certification->Office->getFirstMediaUrl('offices')}}" class="h-10 w-10 rounded-full shadow shadow-etudes-orange" alt="">
                        <div class="">
                            <div class="font-semibold">Proposé par :</div>
                            <div class="font-semibold text-etudes-blue">{{$certification->Office->name}}</div>
                        </div>
                    </div>
                    <div>
                        <div class="text-light">
                            Date :
                        </div>
                        <div class="font-semibold text-etudes-blue capitalize">{{$certification->carbonHumanBeginDate()}}</div>
                    </div>
                    <div>
                        <div class="text-light">
                            Lieu :
                        </div>
                        <div class="font-semibold text-etudes-blue capitalize">
                            {{$certification->location_type == 'online' ? 'En ligne' : 'En présentiel'}}
                        </div>
                    </div>
                </div>
                <div class="border-b border-etudes-orange pb-2">
                    <img src="{{$certification->getFirstMediaUrl('certifications')}}" class="w-full" alt="">
                </div>
                <div class="my-6">
                    <p>
                        {!! html_entity_decode($certification->description) !!}
                    </p>
                </div>
            </div>

            <div class="md:w-4/12 md:sticky md:top-28 mt-10 md:mt-52">
                <div class="bg-white shadow-xl p-4  border rounded-lg">
                    <div class="flex justify-between items-center">
                        @if ($certification->reduction)
                            <span class="text-xl font-semibold text-green-500">
                                @money($certification->price - ($certification->price * ($certification->reduction/100)))
                            </span>
                            <del>@money($certification->price)</del>
                        @else
                            <span class="text-xl font-semibold text-green-500">
                                @money($certification->price )
                            </span>
                        @endif
                    </div>
                    <div class="bg-etudes-orange text-white my-2 p-2 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div class="font-semibold text-lg">Premium <i class="icofont-diamond"></i></div>
                            <span class="text-xl font-semibold">
                                @money($certification->premium_price )
                            </span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-left gap-6 items-center text-sm">
                            <i class="icofont-wall-clock text-xl text-etudes-blue"></i>
                            <div>
                                <div>Du :</div>
                                <div class="text-etudes-blue font-semibold capitalize">{{$certification->carbonHumanBeginDate()}} à {{$certification->carbonHumanBeginHour()}} GMT</div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-left gap-6 items-center text-sm">
                            <i class="icofont-sand-clock text-xl text-etudes-blue"></i>
                            <div>
                                <div>Au :</div>
                                <div class="text-etudes-blue font-semibold capitalize">{{$certification->carbonHumanEndDate()}} à {{$certification->carbonHumanEndHour()}} GMT</div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-left gap-6 items-center text-sm">
                            <i class="icofont-map text-xl text-etudes-blue"></i>
                            <div>
                                <div>Lieu :</div>
                                <div class="text-etudes-blue font-semibold">
                                    {{$certification->location_type == 'online' ? 'En ligne' : 'En présentiel'}}
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-left gap-6 items-start text-sm">
                            <i class="icofont-police-badge text-xl text-etudes-blue"></i>
                            <div>Cabinet reconnu par:
                                <div>
                                    <ul>
                                        @foreach ($certification->Office->Accreditassions as $accreditassion)
                                        <li class="flex justify-between gap-4 py-2 items-center">
                                            <span>{{$accreditassion->acronym}}</span>
                                            <img src="{{$accreditassion->getFirstMediaUrl('accreditassions')}}" class="h-5" alt="">
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-left gap-6 items-center text-sm">
                            <i class="icofont-phone text-xl text-etudes-blue"></i>
                            <div>
                                <div>Téléphone :</div>
                                <div class="text-etudes-blue font-semibold">{{$certification->phone}}</div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="flex justify-left gap-6 items-center text-sm">
                            <i class="icofont-email text-xl text-etudes-blue"></i>
                            <div>
                                <div>Email :</div>
                                <div class="text-etudes-blue font-semibold">{{$certification->email}}</div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div>
                            <a href="{{route('payment', ['slug'=> $certification->slug, 'type'=> 'certification'])}}">
                                <button class="text-center w-full py-3 px-2 rounded-lg bg-etudes-orange font-semibold text-white hover:scale-105 duration-300">S'inscrire</button>
                            </a>
                        </div>
                        @if ($certification->whatsapp)
                            <hr class="my-1">
                            <div>
                                <a href="https://wa.me/{{$certification->whatsapp}}" target="_blank">
                                    <button class="text-center w-full py-3 px-2 rounded-lg bg-green-600 font-semibold text-white hover:scale-105 duration-300"><i class="icofont-brand-whatsapp text-white pr-2"></i>Whatsapp</button>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="my-6 md:my-3 bg-white rounded-lg shadow-lg shadow-etudes-blue">
                    <div class="text-center uppercase font-medium text-etudes-blue text-xl p-4">
                        Proposé par
                    </div>
                    <div class="mt-4 p-10 h-60">
                        <img src="{{$certification->Office->getFirstMediaUrl('offices')}}" class="mx-auto h-36" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-4 md:mx-0 md:w-8/12 flex-none pb-3 md:pb-6 flex justify-left items-center gap-10 border-b mb-2 mt-16 md:mt-0 border-gray-400">
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
                <a target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{ $certification->name}} {{Request::url()}}  @etudesci','popup','width=600,height=600'); return false;">
                    <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                        <i class="icofont-twitter text-white"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
