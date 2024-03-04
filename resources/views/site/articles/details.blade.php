@extends('site.app', [
    'title' => $article->title,
    'active' => 'articles',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">{{$article->title}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('article.list')}}" class="line-clamp-1">
                            Liste des articles
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1">
                        {{$article->title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div class="md:flex justify-between gap-10 items-start">
            <div class="md:w-8/12 shadow-lg shadow-etudes-blue p-2">
                <img src="{{$article->getFirstMediaUrl('articles')}}" class="w-full" alt="">
                <div class="mt-4 px-2">
                    <span class="text-3xl font-light">
                        {{$article->title}}
                    </span>
                    <div class="flex justify-left items-center gap-6 md:gap-8 mt-4 font-light text-sm md:text-base">
                        <div>
                            <i class="text-lg icofont-ui-calendar text-etudes-orange"></i>
                            {{$article->carbonHumanDate()}}
                        </div>
                        <div>
                            <i class="text-lg icofont-quill-pen text-etudes-orange"></i>
                            @foreach ($article->Authors as $author)
                                <span>
                                    {{$author->last_name}}
                                    {{$author->first_name}}
                                </span>
                            @endforeach
                        </div>
                        <div>
                            <i class="icofont-ui-tag text-etudes-orange pr-1"></i>
                            @foreach ($article->Domaines as $domaine)
                                <span>
                                    {{$domaine->label}}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="my-6 font-light">
                        <p>
                            {!! html_entity_decode($article->text) !!}
                        </p>
                    </div>
                    <div class="pb-6 flex justify-left items-center gap-10 border-b mb-2 border-gray-400">
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
                            <a target="popup" onclick="window.open('https://twitter.com/intent/tweet?text={{ $article->name}} {{Request::url()}}  @etudesci','popup','width=600,height=600'); return false;">
                                <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                                    <i class="icofont-twitter text-white"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" mt-10 md:mt-0 md:w-4/12 sticky top-20">
                <div class="mb-4">
                    <div class="text-xl pb-2 border-b">Cours</div>
                    <div class="">
                        @foreach ($courses as $course)
                            <div class="flex justify-left items-center gap-4 items-stretch my-6">
                                <a href="{{$course->detailsUrl()}}" class="w-1/3">
                                    <img src="{{$course->getFirstMediaUrl('courses')}}" class="rounded-xl shadow-lg shadow-etudes-blue/[.6]" alt="">
                                </a>
                                <div class="w-2/3">
                                    <span class="py-1 px-2 text-violet-500 text-sm bg-violet-500/[.2] rounded-lg">{{$course->Domaines[0]->label}}</span>
                                    <div class="mt-2 truncate text-etudes-blue">
                                        <a href="{{$course->detailsUrl()}}">
                                            {{$course->title}}
                                        </a>
                                    </div>
                                    <div class="text-xs font-thin">
                                        Ajouté le {{$course->carbonHumanDate()}}
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
            </div>
        </div>
    </div>
</div>
@endsection
