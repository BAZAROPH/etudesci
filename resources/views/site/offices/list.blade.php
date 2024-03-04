@extends('site.app', [
    'title' => 'Liste des cabinets de formation',
    'active' => 'offices',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="mx-5 md:mx-10 md:p-10 text-4xl  text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">Nos cabinets de formation</div>
                <div class="h-10 bg-etudes-orange mt-4 md:max-w-md rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                    <div class="font-bold">
                        Liste des cabinets de formation
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="my-5 bg-gray-200 rounded-lg p-4 flex items-center justify-between gap-4">
            <div class="flex justify-between items-center w-3/5 border-2 border-gray-300 p-1 rounded-xl peer">
                <input type="text" class="bg-transparent w-full px-2 focus:outline-none text-etudes-blue placeholder-etudes-blue search-input" @if(!$domaines->contains('label', $subject) && !is_null($subject)) value="{{$subject}}" @endif placeholder="Rechercher un cabinet ...">
                <button class="bg-etudes-blue text-white px-2 py-1 rounded-xl search-button">
                    <i class="icofont-search-2"></i>
                </button>
            </div>
            <select name="" class="w-2/5 bg-white py-3 px-2 rounded-lg search-select" link='{{route('office.list')}}' id="">
                <option value="">Trier par domaine</option>
                @foreach ($domaines as $domaine)
                    <option value="{{$domaine->label}}" @if($domaine->label == $subject) selected='selected' @endif>{{$domaine->label}}</option>
                @endforeach
            </select>
        </div>
        <div class="my-8 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="col-span-2 space-y-8 mt-2">
                @forelse ($offices as $office)
                    <div class="border p-2 rounded-xl shadow-lg shadow-etudes-orange/[.5]">
                        <div class="grid grid-cols-1 md:grid-cols-3">
                            <div>
                                <a href="{{$office->detailsUrl()}}">
                                    <img src="{{$office->getFirstMediaUrl('offices')}}" class="h-60 p-10 rounded-xl mx-auto" alt="">
                                </a>
                            </div>
                            <div class="col-span-2 p-5">
                                <div class="text-2xl text-etudes-blue mb-4 font-bold text-center md:text-left">
                                    <a href="{{$office->detailsUrl()}}">
                                        {{$office->name}}
                                    </a>
                                </div>
                                <div class="line-clamp-3 font-light text-sm leading-7 text-justify">
                                    {!! html_entity_decode($office->description) !!}
                                </div>
                                <div class="items-center justify-between space-x-4 md:space-x-6 space-y-4 flex-wrap text-center md:text-left">
                                    <button class="py-1 px-1.5 text-white text-sm rounded-lg bg-etudes-orange">Formation</button>
                                    <button class="py-1 px-1.5 text-white text-sm rounded-lg bg-etudes-orange">Marketing</button>
                                    <button class="py-1 px-1.5 text-white text-sm rounded-lg bg-etudes-orange">Formation</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="grid place-items-center w-full col-span-2">
                        <div class="text-3xl font-bold text-gray-300">Aucun résultat</div>
                    </div>
                @endforelse
                <div class="mt-8">
                    {{$offices->links('vendor.pagination.customs')}}
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="text-xl pb-2 border-b">Certifications récentes</div>
                    <div class="">
                        @foreach ($certifications as $certification)
                            <div class="flex justify-left items-center gap-4 items-center my-6">
                                <a href="{{$certification->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$certification->getFirstMediaUrl('certifications')}}" class="rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
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

                <div class="mt-12 md:mt-16 mb-4">
                    <div class="text-xl pb-2 border-b">Articles récentes</div>
                    <div class="">
                        @foreach ($articles as $article)
                            <div class="flex justify-left items-center gap-4 items-stretch my-6">
                                <a href="{{$article->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$article->getFirstMediaUrl('articles')}}" class="rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
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
            </div>
        </div>
    </div>
</div>
@endsection
