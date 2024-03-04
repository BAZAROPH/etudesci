@extends('site.app', [
    'title' => 'Liste des évènements professionnels',
    'active' => 'events',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="mx-5 md:mx-10 md:p-10 text-4xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">Nos évènements professionnels</div>
                <div class="h-10 bg-etudes-orange mt-4 max-w-md rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                    <div class="font-bold">
                        Liste des évènements professionnels
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="my-5 bg-gray-200 rounded-lg p-4 flex items-center justify-between gap-4">
            <div class="flex justify-between items-center w-3/5 border-2 border-gray-300 p-1 rounded-xl peer">
                <input type="text" class="bg-transparent w-full px-2 focus:outline-none text-etudes-blue placeholder-etudes-blue search-input" @if(!$types->contains('label', $subject) && !is_null($subject)) value="{{$subject}}" @endif placeholder="Rechercher un évènement ...">
                <button class="bg-etudes-blue text-white px-2 py-1 rounded-xl search-button">
                    <i class="icofont-search-2"></i>
                </button>
            </div>
            <select name="" class="w-2/5 bg-white py-3 px-2 rounded-lg search-select" link='{{route('event.list')}}' id="">
                <option value="">Trier par Type</option>
                @foreach ($types as $type)
                    <option value="{{$type->label}}" @if($type->label == $subject) selected='selected' @endif>{{$type->label}}</option>
                @endforeach
            </select>
        </div>

        <div class="my-8 grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
            <div class="col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($events as $event)
                        <div class="shadow-xl border rounded-xl">
                            <div class="w-full relative">
                                <span class="px-2 py-1 rounded-lg bg-etudes-orange text-white absolute ml-2 mt-2">{{$event->Domaines[0]->label}}</span>
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
                                        <span>{{$event->carbonHumanHour()}}</span>
                                    </div>
                                </div>
                                <div class="my-4 flex justify-between items-center">
                                    <div class="truncate max-w-[13em]">
                                        <i class="icofont-location-arrow text-etudes-blue "></i>
                                        {{$event->place}}
                                    </div>
                                    <span class="font-semibold text-lg text-green-500 border-l-2 border-etudes-blue pl-2">
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
                                </div>
                                <div class="text-xl font-semibold text-etudes-blue mt-4 line-clamp-1">
                                    <a href="{{$event->detailsUrl()}}">
                                        {{$event->name}}
                                    </a>
                                </div>
                            </div>
                            @if ($event->price)
                                <div class="border-gray-300 border-t p-4 flex justify-between items-center text-white bg-etudes-orange rounded-b-xl hover:scale-110 hover:rounded-t-xl duration-300 cursor-pointer">
                                    <span class="font-bold text-xl"><i class="icofont-diamond"></i> Premium</span>
                                    <span class="font-bold text-lg">
                                        @money($event->premium_price)
                                    </span>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="grid place-items-center w-full col-span-2">
                            <div class="text-3xl font-bold text-gray-300">Aucun résultat</div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{$events->links('vendor.pagination.customs')}}
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="text-xl pb-2 border-b">Articles récents</div>
                    <div class="">
                        @foreach ($articles as $article)
                            <div class="flex justify-left items-center gap-4 items-stretch my-6">
                                <a href="{{$article->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$article->getFirstMediaUrl('articles')}}" class=" rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                </a>
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg"> {{$article->Type->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        <a href="{{$article->detailsUrl()}}">
                                            {{$article->title}}
                                        </a>
                                    </div>
                                    <div class="text-xs font-thin">
                                        Publié le {{$article->carbonHumanDate()}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12 md:mt-16 mb-4">
                    <div class="text-xl pb-2 border-b">Certifications récentes</div>
                    <div class="">
                        @foreach ($certifications as $certification)
                            <div class="flex justify-left items-center gap-4 items-center my-6">
                                <a href="{{$certification->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$certification->getFirstMediaUrl('certifications')}}" class=" rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                </a>
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg">{{$certification->Domaines[0]->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        <a href="{{$certification->detailsUrl()}}">
                                            {{$certification->title}}
                                        </a>
                                    </div>
                                    <div class="text-xs font-thin">
                                        Ajouté le {{$certification->carbonHumanDate()}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
