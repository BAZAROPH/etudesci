@extends('site.app', [
    'title' => 'Liste des certifications',
    'active' => 'certifications',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="mx-10 p-10 text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">Nos certifications</div>
                <div class="h-10 bg-etudes-orange mt-4 max-w-md rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                    <div class="font-bold">
                        Liste des certifications
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="my-5 bg-gray-200 rounded-lg p-4 flex items-center justify-between gap-4">
            <div class="flex justify-between items-center w-3/5 border-2 border-gray-300 p-1 rounded-xl peer">
                <input type="text" class="bg-transparent w-full px-2 focus:outline-none text-etudes-blue placeholder-etudes-blue search-input" @if($subject != 'online' && $subject != 'present' && !is_null($subject)) value="{{$subject}}" @endif placeholder="Rechercher une certification ...">
                <button class="bg-etudes-blue text-white px-2 py-1 rounded-xl search-button">
                    <i class="icofont-search-2"></i>
                </button>
            </div>
            <select name="" class="w-2/5 bg-white py-3 px-2 rounded-lg search-select" link='{{route('certification.list')}}' id="">
                <option value="">Trier par domaine</option>
                <option value="online" @if($subject == 'online') selected='selected' @endif>En ligne</option>
                <option value="present" @if($subject == 'present') selected='selected' @endif>En présentiel</option>
            </select>
        </div>
        <div class="my-8 grid grid-cols-1 md:grid-cols-3 gap-10 items-start">
            <div class="col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse ($certifications as $certification)
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
                                        <span>{{$certification->carbonHumanBeginDate()}}</span>
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
                            @if ($certification->price)
                                <a href="{{route('payment', ['slug'=> $certification->slug, 'type'=> 'certification'])}}">
                                    <div class="border-gray-300 border-t p-4 flex justify-between items-center text-white bg-etudes-orange rounded-b-xl hover:scale-110 hover:rounded-t-xl duration-300 cursor-pointer">
                                        <span class="font-bold text-xl"><i class="icofont-diamond"></i> Premium</span>
                                        <span class="font-bold text-lg">
                                            @money($certification->premium_price )
                                        </span>
                                    </div>
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="grid place-items-center w-full col-span-2">
                            <div class="text-3xl font-bold text-gray-300">Aucun résultat</div>
                        </div>
                    @endforelse
                </div>
                <div class="mt-8">
                    {{$certifications->links('vendor.pagination.customs')}}
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <div class="text-xl pb-2 border-b">Articles récents</div>
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

                <div class="mt-12 md:mt-16 mb-4">
                    <div class="text-xl pb-2 border-b">Livres</div>
                    <div class="">
                        @foreach ($books as $book)
                            <div class="flex justify-left items-center gap-4 items-center my-6">
                                <a href="{{$book->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$book->getFirstMediaUrl('books')}}" class="rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                </a>
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg">{{$book->Domaines[0]->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        <a href="{{$book->detailsUrl()}}">
                                            {{$book->title}}
                                        </a>
                                    </div>
                                    <div class="text-xs font-thin">
                                        Ajouté le {{$book->carbonHumanDate()}}
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
