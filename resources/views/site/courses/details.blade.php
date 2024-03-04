@extends('site.app', [
    'title' => $course->title,
    'active' => 'courses',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">{{$course->title}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4 md:mr-16">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('book.list')}}" class="line-clamp-1">
                            Liste des cours
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1">
                        {{$course->title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-sm md:max-w-6xl py-8 mx-auto">
        <div class="mx-4 md:mx-0 md:flex justify-between items-start gap-10 bg-white">
            <div class="md:w-8/12">
                <div class="my-10 flex items-center justify-left gap-10 border p-4 rounded-xl border-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}">
                    <div class="flex items-center justify-left gap-6">
                        <img src="{{$course->Trainer->getFirstMediaUrl('trainers')}}" class="h-12 w-12 rounded-full border border-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} shadow shadow-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}" alt="">
                        <div class="text-sm">
                            <div>Speaker:</div>
                            <div class="capitalize text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} font-semibold">{{$course->Trainer->last_name}} {{$course->Trainer->first_name}}</div>
                        </div>
                    </div>
                    <div class="text-sm">
                        <div>Domaine:</div>
                        <div class="flex flex-wrap justify-left gap-2">
                            @foreach ($course->Domaines as $domaine)
                                <span class="capitalize font-semibold py-1 px-2 rounded-xl bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} text-white text-xs">{{$domaine->label}}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <img src="{{$course->getFirstMediaUrl('courses')}}" class="w-full" alt="">
                </div>
                <div class="mt-4 grid grid-cols-4 text-center mx-auto divide-x divide-gray-400 bg-gray-200 rounded-lg font-medium text-xs md:text-base">
                    <button class="p-2 md:p-3 hover:bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} hover:text-white duration-300 rounded-l-lg default-active" id="description" onclick="openTabs(event)">
                        <i class="icofont-read-book text-xs md:text-lg"></i>
                        Description
                    </button>
                    <button class="p-2 md:p-3 hover:bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} hover:text-white duration-300" id="modules" onclick="openTabs(event)">
                        <i class="icofont-bricks text-xs md:text-lg"></i>
                        Modules
                    </button>
                    <button class="p-2 md:p-3 hover:bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} hover:text-white duration-300 " id="speakers" onclick="openTabs(event)">
                        <i class="icofont-man-in-glasses text-xs md:text-lg"></i>
                        Spearker(s)
                    </button>
                    <button class="p-2 md:p-3 hover:bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} hover:text-white duration-300 rounded-r-lg" id="comments" onclick="openTabs(event)">
                        <i class="icofont-comment text-xs md:text-lg "></i>
                        Commentaire
                    </button>
                </div>

                <div class="hidden tab-content my-4" data-target="description">
                    <p class="text-justify text-sm md:text-base">
                        {!! html_entity_decode($course->description) !!}
                    </p>
                </div>

                <div class="hidden tab-content my-4" data-target="modules">
                    <ul class="space-y-4 border p-2 rounded-lg font-semibold text-sm md:text-base">
                        @foreach ($course->Modules as $module)
                            <li class="">
                                <div class="duration-300 cursor-pointer py-4 px-5 rounded-lg bg-gray-200 flex justify-between items-center" id="accordion-{{$loop->index}}" onclick="openAccordion(event)">
                                    <span class="select-none">Module 0{{$loop->index + 1}}: {{$module->title}}</span>
                                    <i class="icofont-rounded-down"></i>
                                </div>
                                <div  class="duration-300 transition-all overflow-hidden max-h-0 ease-in-out flex justify-between items-start gap-4 font-light accordion-content" data-toggle="accordion-{{$loop->index}}">
                                    <div class="w-10/12">
                                        {!! html_entity_decode($module->description) !!}
                                    </div>
                                    <div class="2/12">
                                        {{$module->duration}} min <i class="icofont-clock-time text-xl text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>

                <div class="hidden tab-content my-4" data-target="speakers">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <img src="{{$course->Trainer->getFirstMediaUrl('trainers')}}" class="w-full rounded-xl" alt="">
                        </div>
                        <div class="md:col-span-2 bg-gray-200 rounded-xl w-full p-8 relative">
                            <div class="">
                                <p class="text-justify">
                                    {!! html_entity_decode($course->Trainer->description) !!}
                                </p>
                            </div>
                            <div class="mt-4 md:mt-0 md:absolute bottom-2">
                                <div class="flex justify-left items-center gap-4 bottom-0">
                                    @if ($course->Trainer->facebook)
                                        <a href="{{$course->Trainer->facebook}}" target="_blank">
                                            <button class="text-xl px-2 p-1 rounded-lg bg-[#4267B2] hover:scale-150 duration-300">
                                                <i class="icofont-facebook text-white"></i>
                                            </button>
                                        </a>
                                    @endif

                                    @if ($course->Trainer->linkedin)
                                        <a href="{{$course->Trainer->linkedin}}" target="_blank">
                                            <button class="text-xl px-2 p-1 rounded-lg bg-[#0077B5] hover:scale-150 duration-300">
                                                <i class="icofont-linkedin text-white"></i>
                                            </button>
                                        </a>
                                    @endif

                                    @if ($course->Trainer->twitter)
                                        <a href="{{$course->Trainer->twitter}}" target="_blank">
                                            <button class="text-xl px-2 p-1 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                                                <i class="icofont-twitter text-white"></i>
                                            </button>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden tab-content my-4 p-4" data-target="comments">
                    <div class="text-2xl font-bold">
                        0 Commentaire(s)
                    </div>
                    <div class="my-4">
                        <button class="text-xl font-semibold text-white bg-etudes-orange px-4 py-2 rounded-lg hover:bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} duration-300 hover:shadow-lg hover:shadow-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}">Commenter</button>
                    </div>
                </div>
            </div>

            <div class="md:w-4/12 md:sticky md:top-28 mt-10 md:mt-18">
                <div class="shadow-xl border border-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} rounded-lg p-4 shadow-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}">
                    <div class=" rounded-xl">
                        <iframe class="w-full h-52 rounded-xl" src="{{$course->youtube}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                    <div class="text-xl mt-8 font-semibold text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} pl-2">
                        {{$course->type == 'onlineclass' ? 'Premium' : 'Gratuit'}}
                    </div>
                    <div class="mt-6 border border-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} rounded-lg py-4 px-6">
                        <ul>
                            <li class="flex flex-col justify-between font-light">
                                <div class="flex items-center gap-2">
                                    <i class="text-lg icofont-man-in-glasses text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i>
                                    Speaker
                                </div>
                                <span class="text-sm truncate">{{$course->Trainer->last_name}} {{$course->Trainer->first_name}}</span>
                                <div class="flex items-center gap-2">
                                    {{-- <i class="text-lg icofont-flame-torch text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i> --}}
                                    <span>{{$course->Trainer->function}}</span>
                                </div>
                            </li>
                            {{-- <hr class="my-4">
                            <li class="flex justify-between font-light">

                                <span>{{$course->Trainer->function}}</span>
                            </li> --}}
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div class="flex items-center gap-2">
                                    <i class="text-lg icofont-mail-box text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i>
                                    Module
                                </div>
                                <span class="uppercase">{{count($course->Modules)}}</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div class="flex items-center gap-2">
                                    <i class="text-lg icofont-sand-clock text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i>
                                    Durée
                                </div>
                                <span class="uppercase">{{$course->Modules->sum('duration') < 60 ? $course->Modules->sum('duration') : intdiv($course->Modules->sum('duration'),60).'h'.$course->Modules->sum('duration')%60}} min</span>
                            </li>
                            <hr class="my-4">
                            <li class="flex justify-between font-light">
                                <div class="flex items-center gap-2">
                                    <i class="text-lg icofont-group-students text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}"></i>
                                    Nombre de participant
                                </div>
                                <span class="uppercase">{{count($course->Users)+26}}</span>
                            </li>
                        </ul>
                        <div class="mt-10 text-center">
                            @if (Auth::check() && Auth::user()->Subscription)
                                <a href="{{route('course.taken', ['slug'=>$course->slug, 'module_slug'=>$course->Modules[0]->slug])}}">
                                    <button class="rounded-lg text-white font-medium px-4  py-2 text-xl bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} duration-300 transition-all ease-in-out hover:px-8 hover:bg-etudes-orange">Participer au cours <i class="icofont-ruler-pencil-alt-2 pl-2"></i></button>
                                </a>
                            @else
                                <a href="{{route('subscritption.description')}}">
                                    <button class="rounded-lg text-white font-medium px-4  py-2 text-xl bg-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} duration-300 transition-all ease-in-out hover:px-8 hover:bg-etudes-orange">Participer au cours <i class="icofont-ruler-pencil-alt-2 pl-2"></i></button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="my-8 md:my-6 bg-white rounded-lg shadow-lg shadow-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}}">
                    <div class="text-center uppercase font-medium text-etudes-{{$course->type == 'onlineclass' ? 'orange' : 'blue'}} text-xl p-4">
                        Proposé par
                    </div>
                    <div class="mt-4">
                        <img src="{{$course->Office->getFirstMediaUrl('offices')}}" class="mx-auto h-36 p-6" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('site.auth.loginModal')
@endsection
