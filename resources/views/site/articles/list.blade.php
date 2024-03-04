@extends('site.app', [
    'title' => 'Liste des articles',
    'active' => 'articles',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="mx-10 p-10 text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">Nos articles</div>
                <div class="h-10 bg-etudes-orange mt-4 max-w-md rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                    <div class="font-bold">
                        Liste des articles
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="my-5 bg-gray-200 rounded-lg p-4 flex items-center justify-between gap-4">
            <div class="flex justify-between items-center w-3/5 border-2 border-gray-300 p-1 rounded-xl peer">
                <input type="text" class="bg-transparent w-full px-2 focus:outline-none text-etudes-blue placeholder-etudes-blue search-input" @if(!$types->contains('label', $subject) && !is_null($subject)) value="{{$subject}}" @endif placeholder="Rechercher un article ...">
                <button class="bg-etudes-blue text-white px-2 py-1 rounded-xl search-button">
                    <i class="icofont-search-2"></i>
                </button>
            </div>
            <select name="" class="w-2/5 bg-white py-3 px-2 rounded-lg search-select" link='{{route('article.list')}}' id="">
                <option value="">Trier par Type</option>
                @foreach ($types as $type)
                    <option value="{{$type->label}}" @if($type->label == $subject) selected='selected' @endif>{{$type->label}}</option>
                @endforeach
            </select>
        </div>
        <div class="my-8 grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
            <div class="col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($articles as $article)
                        <div class="bg-white shadow-xl shadow-etudes-blue/[.3] rounded-xl">
                            <div>
                                <a href="{{$article->detailsUrl()}}">
                                    <img src="{{$article->getFirstMediaUrl('articles')}}" class="h-64 border-t-etudes-blue border-t w-full mx-auto rounded-t-xl" alt="">
                                </a>
                            </div>
                            <div class="bg-white p-4 space-x-2 max-w-sm mx-auto rounded-b-xl">
                                <div>
                                    <span class="px-2 py-1 rounded text-white bg-green-600/[.2] font-medium text-sm text-green-600">{{$article->Type->label}}</span>
                                </div>
                                <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-1">
                                    <a href="{{$article->detailsUrl()}}">
                                        {{$article->title}}
                                    </a>
                                </div>
                                <div class=" flex justify-between gap-5 items-center mt-10">
                                    <div class="flex justify-center items-center gap-4">
                                        <button class="text-xl px-2 p-1 rounded-lg bg-[#4267B2] hover:scale-150 duration-300">
                                            <i class="icofont-facebook text-white"></i>
                                        </button>
                                        <button class="text-xl px-2 p-1 rounded-lg bg-[#0077B5] hover:scale-150 duration-300">
                                            <i class="icofont-linkedin text-white"></i>
                                        </button>
                                        <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                                            <i class="icofont-twitter text-white"></i>
                                        </button>
                                    </div>
                                    <div>
                                        {{$article->carbonHumanDate()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="grid place-items-center w-full col-span-2">
                            <div class="text-3xl font-bold text-gray-300">Aucun résultat</div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{$articles->links('vendor.pagination.customs')}}
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="text-xl pb-2 border-b">Évènements proches</div>
                    <div class="">
                        @foreach ($events as $event)
                            <div class="flex justify-left items-center gap-4 items-center my-6">
                                <img src="{{$event->getFirstMediaUrl('events')}}" class="w-1/3 rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg">{{$event->Type->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        {{$event->name}}
                                    </div>
                                    <div class="text-xs font-thin">
                                        Publié le {{$event->carbonHumanDate()}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-12 md:mt-16 mb-4">
                    <div class="text-xl pb-2 border-b">Formations</div>
                    <div class="">
                        @foreach ($certifications as $certification)
                            <div class="flex justify-left items-center gap-4 items-center my-6">
                                <img src="{{$certification->getFirstMediaUrl('certifications')}}" class="w-1/3 rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg">{{$certification->Domaines[0]->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        {{$certification->title}}
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
