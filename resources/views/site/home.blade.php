@extends('site.app', [
    'title' => 'Accueil',
    'active' => 'home',
])

@section('content')
    <div class="max-w-sm md:max-w-6xl my-8 mx-auto">
        <div>
            <a href="{{route('subscritption.description')}}">
                <img src="{{asset('site/assets/test/pub_1672317136.png')}}" class="w-full" alt="">
            </a>
        </div>

        {{-- articles --}}
        <div class="my-10 md:grid md:grid-cols-2 gap-6">
            {{-- slide 1 --}}
            <div class="article-slide-horizontal">
                @foreach ($left_articles as $article)
                    <div class="">
                        <div>
                            <a href="{{$article->detailsUrl()}}">
                                <img src="{{$article->getFirstMediaUrl('articles')}}" alt="">
                            </a>
                        </div>
                        <div class="mt-2 font-thin space-x-2">
                            <i class="icofont-ui-calendar text-etudes-orange"></i>
                            <span> {{$article->carbonHumanDate()}}</span>
                        </div>
                        <div class="mt-2 text-2xl">
                            <a href="{{$article->detailsUrl()}}">
                                {{$article->title}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- slide 2 --}}
            <div class="article-slide-vertical mt-6 ùd:mt-0">
                @foreach ($right_articles as $article)
                    <div class="mt-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <a href="{{$article->detailsUrl()}}">
                                    <img src="{{$article->getFirstMediaUrl('articles')}}" class="h-36" alt="">
                                </a>
                            </div>
                            <div class="col-span-2">
                                <div class="mt-2 font-thin space-x-2">
                                    <i class="icofont-ui-calendar text-etudes-orange"></i>
                                    <span>{{$article->carbonHumanDate()}}</span>
                                </div>
                                <div class="mt-2 text-2xl">
                                    <a href="{{$article->detailsUrl()}}">
                                        {{$article->title}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Courses --}}
        <div class="mb-10 mt-16">
            <div class="text-center w-full relative">
                <div class="text-4xl capitalize">Cours & Online Classroom</div>
                <div class="mt-2 font-light text-sm">Pour renforcer vos capacités professionnelles.</div>
            </div>

            <div class="mt-6">
                <div class="course-slide w-full">
                    @foreach ($courses as $course)
                        <div class="bg-white shadow-xl {{$course->type == 'onlineclass' ? 'shadow-etudes-orange rounded-xl' : ''}}">
                            <div>
                                <a href="{{$course->detailsUrl()}}">
                                    <img src="{{$course->getFirstMediaUrl('courses')}}" class="h-64 w-full mx-auto" alt="">
                                </a>
                            </div>
                            <div class="bg-white p-4 space-x-2 max-w-sm mx-auto {{$course->type == 'onlineclass' ? 'rounded-xl' : ''}}">
                                <div>
                                    <span class="px-2 py-1 rounded text-white bg-green-600 font-light text-sm">{{$course->Domaines[0]->label}}</span>
                                    <span class="px-2 py-1 rounded {{$course->type == 'onlineclass' ? ' bg-etudes-orange/[.2]' : 'bg-green-600/[.2]'}} font-medium text-sm text-{{$course->type == 'onlineclass' ? 'etudes-orange' : 'green-600'}}">{{$course->type == 'onlineclass' ? 'Premium' : 'Gratuit'}}</span>
                                </div>
                                <div class="text-xl font-semibold text-etudes-blue my-4 line-clamp-2">
                                    <a href="{{$course->detailsUrl()}}">
                                        {{$course->title}}
                                    </a>
                                </div>
                                <div class="border-t border-gray-400 p-3 flex justify-left gap-5 items-center">
                                    <img src="{{$course->Trainer->getFirstMediaUrl('trainers')}}" class="h-14 w-14 rounded-full  border border-etudes-blue" alt="">
                                    <span class="capitalize text-etudes-blue tracking-widest">{{$course->Trainer->first_name}} {{$course->Trainer->last_name}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="mt-5 text-center">
                    <a href="{{route('course.list')}}">
                        <button class="bg-etudes-blue text-white py-2 px-3 rounded hover:scale-110 duration-300 hover:bg-etudes-orange hover:shadow-xl">Voir tous les cours <i class="icofont-rounded-double-right"></i></button>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        {{-- Certification --}}
        <div class="mb-10 mt-14">
            <div class="text-center w-full relative">
                <div class="text-4xl capitalize">Certifications</div>
                <div class="mt-2 font-light text-sm max-w-md mx-auto">Un accès à des certificats de qualité, fiables et adaptés à vos besoins de renforcement de capacités professionnelles.</div>
            </div>

            <div class="mt-6">
                <div class="w-full course-slide">
                    @foreach ($certifications as $certification)
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
                            <a href="{{route('payment', ['slug'=> $certification->slug, 'type'=> 'certification'])}}">
                                <div class="border-gray-300 border-t p-4 flex justify-between items-center text-white bg-etudes-orange rounded-b-xl hover:rounded-t-xl duration-300 cursor-pointer">
                                    <span class="font-bold text-xl"><i class="icofont-diamond"></i> Premium</span>
                                    <span class="font-bold text-lg">
                                        @money($certification->premium_price )
                                    </span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-5 text-center">
                    <a href="{{route('certification.list')}}">
                        <button class="bg-etudes-blue text-white py-2 px-3 rounded hover:scale-110 duration-300 hover:bg-etudes-orange hover:shadow-xl">Voir toutes les certifications <i class="icofont-rounded-double-right"></i></button>
                    </a>
                </div>
            </div>
        </div>

        <hr>

        {{-- Events --}}
        {{-- <div class="mb-10 mt-14">
            <div class="text-center w-full relative">
                <div class="text-4xl capitalize">Evènements professionnels </div>
                <div class="mt-2 font-light text-sm max-w-md mx-auto">Participez aux évènements qui vous rapprochent de vos objectifs, et agrandissez votre reseau professionnel.</div>
            </div>

            <div class="mt-6">
                <div class="w-full course-slide">
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
                                    <a href="{{route('event.details', $event->slug)}}">
                                        {{$event->name}}
                                    </a>
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
        </div> --}}

    </div>
@endsection
