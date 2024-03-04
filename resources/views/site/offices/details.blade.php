@extends('site.app', [
    'title' => $office->name,
    'active' => 'offices',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold uppercase">{{$office->name}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('office.list')}}" class="line-clamp-1">
                            Liste des cabinets
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1 capitalize">
                        {{$office->name}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl py-8 mx-auto">
        <div class="mx-4 md:mx-0 md:flex justify-between items-start gap-10 bg-white">
            <div class="md:w-4/12 md:sticky md:top-28 md:mt-10 md:mt-18 p-4 shadow-xl rounded-xl border">
                <div>
                    <img src="{{$office->getFirstMediaUrl('offices')}}" class="mx-auto" alt="">
                </div>
                <div class="mt-4 uppercase text-center font-bold text-xl text-etudes-blue">
                    {{$office->name}}
                </div>
                <div class="mt-4 flex justify-center items-center gap-4 mx-auto">
                    @if ($office->facebook)
                        <a href="{{$office->facebook}}">
                            <button class="text-sm px-2 p-1 rounded-lg bg-[#4267B2] hover:scale-150 duration-300">
                                <i class="icofont-facebook text-white"></i>
                            </button>
                        </a>
                    @endif

                    @if ($office->linkedin)
                        <a href="{{$office->linkedin}}">
                            <button class="text-sm px-2 p-1 rounded-lg bg-[#0077B5] hover:scale-150 duration-300">
                                <i class="icofont-linkedin text-white"></i>
                            </button>
                        </a>
                    @endif

                    @if ($office->twitter)
                        <a href="{{$office->twitter}}">
                            <button class="text-sm px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                                <i class="icofont-twitter text-white"></i>
                            </button>
                        </a>
                    @endif
                </div>
                <div class="mt-8">
                    <ul>
                        <li class=" px-2 flex justify-left gap-4">
                            <div class="flex justify-left items-center gap-1">
                                <i class="icofont-ui-email"></i>
                                <span>Email</span>
                            </div>
                            <div class="text-etudes-blue font-medium">
                                {{$office->email}}
                            </div>
                        </li>
                        <hr class="my-4">
                        <li class=" px-2 flex justify-left gap-4">
                            <div class="flex justify-left items-center gap-1">
                                <i class="icofont-headphone-alt-2"></i>
                                <span>Contact</span>
                            </div>
                            <div class="text-etudes-blue font-medium">
                                {{$office->phone}}
                            </div>
                        </li>
                        <hr class="my-4">
                        <li class=" px-2 flex justify-left gap-4">
                            <div class="flex justify-left items-center gap-1">
                                <i class="icofont-web"></i>
                                <span>Site web</span>
                            </div>
                            <div class="text-etudes-blue font-medium">
                                {{$office->website}}
                            </div>
                        </li>
                        <hr class="my-4">
                        <li class=" px-2 flex justify-left gap-4">
                            <div class="flex justify-left items-center gap-1">
                                <i class="icofont-location-pin"></i>
                                <span>Adresse</span>
                            </div>
                            <div class="text-etudes-blue font-medium">
                                {{$office->address}}
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="md:w-8/12">
                <div class="flex justify-between items-center bg-white border mt-10 md:mt-0">
                    <button class="text-center w-1/2 hover:bg-etudes-blue hover:text-white py-4 duration-300 default-active" onclick="openTabs(event)" id="description">Description</button>
                    <button class="text-center w-1/2 hover:bg-etudes-blue hover:text-white py-4 duration-300" onclick="openTabs(event)" id="formation">Formation</button>
                </div>
                <div class="hidden tab-content my-4" data-target="description">
                    <p class="text-justify text-sm md:text-base">
                        {!! html_entity_decode($office->description) !!}
                    </p>
                </div>

                <div class="hidden tab-content my-4" data-target="formation">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($office->Certifications as $certification)
                            <div class="shadow-xl border rounded-xl">
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
                                            {{$certification->location_type == 'online' ? 'En ligne' : 'En présentiel'}}
                                        </div>
                                    </div>
                                    <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-1">
                                        <a href="{{$certification->detailsUrl()}}">
                                            {{$certification->title}}
                                        </a>
                                    </div>
                                    <div class=" flex justify-between gap-5 items-center">
                                        <div class="border-r-2 border-etudes-blue w-1/2">
                                            <img src="{{$certification->Office->getFirstMediaUrl('offices')}}" class="h-14 w-14 rounded-full  border border-etudes-blue" alt="">
                                            <span class="capitalize text-etudes-blue tracking-widest">{{$certification->Office->name}}</span>
                                        </div>
                                        <div>
                                            <span class="text-green-500 font-bold text-xl text-right">
                                                @if ($certification->reduction)
                                                    @money($certification->price - ($certification->price * ($certification->reduction/100)))
                                                @else
                                                    @money($certification->price )
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-gray-300 border-t p-4 flex justify-between items-center text-white bg-etudes-orange rounded-b-xl hover:scale-110 hover:rounded-t-xl duration-300 cursor-pointer">
                                    <span class="font-bold text-xl"><i class="icofont-diamond"></i> Premium</span>
                                    <span class="font-bold text-lg">
                                        @money($certification->premium_price )
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-4 md:mx-0  flex-none pb-3 md:pb-6 flex justify-left items-center gap-10 border-b mb-2 mt-16 border-gray-400">
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
                <a target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{ $office->name}} {{Request::url()}}  @etudesci','popup','width=600,height=600'); return false;">
                    <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                        <i class="icofont-twitter text-white"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
