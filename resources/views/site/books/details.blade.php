@extends('site.app', [
    'title' => $book->title,
    'active' => 'books',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold">{{$book->title}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
                    <div>
                        <a href="{{route('home')}}">
                            Accueil
                        </a>
                    </div>
                    <span>-</span>
                        <a href="{{route('book.list')}}" class="line-clamp-1">
                            Liste des livres et ebooks
                        </a>
                    <span>-</span>
                    <div class="font-bold line-clamp-1">
                        {{$book->title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-200">
        <div class="max-w-sm md:max-w-6xl py-8 mx-auto">
            <div class="mx-4 md:mx-0 grid grid-cols-1 md:grid-cols-2 gap-10 bg-white rounded-lg p-10 shadow-xl items-start">
                <div class="md:sticky md:top-28">
                    <div class="mb-6">
                        <button class="px-4 py-2 rounded-xl hover:bg-green-600 bg-etudes-blue text-white font-bold text-xl duration-300">Commander <i class="icofont-pay text-2xl pl-2"></i></button>
                    </div>
                    <img src="{{$book->getFirstMediaUrl('books')}}" class="w-full border-2 border-etudes-blue" alt="">
                </div>
                <div>
                    <div class="text-etudes-blue font-semibold uppercase text-2xl">{{$book->title}}</div>
                    <div class="md:flex justify-between items-center mt-6">
                        <span class="text-lg font-semibold text-green-500">
                            @if ($book->price)
                                @if ($book->reduction)
                                    @money($book->price - ($book->price * ($book->reduction/100)))
                                @else
                                    @money($book->price )
                                @endif
                            @else
                                Gratuit
                            @endif
                        </span>
                        <button class="bg-etudes-orange text-white my-2 p-2 rounded-lg flex justify-between gap-2 md:gap-5 hover:scale-105 duration-300 hover:shadow-lg hover:shadow-etudes-orange">
                            <div class="font-semibold text-lg">Premium <i class="icofont-diamond"></i></div>
                            <span class="text-xl font-semibold">@money($book->premium_price)</span>
                        </button>
                    </div>
                    <div class="my-6">
                        <p class="text-justify">
                            {!! html_entity_decode($book->description) !!}
                        </p>
                    </div>
                    <div class="my-6 text-center">
                        <button class="px-4 py-2 rounded-xl hover:bg-green-600 bg-etudes-blue text-white font-bold text-xl duration-300">Commander <i class="icofont-pay text-2xl pl-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
