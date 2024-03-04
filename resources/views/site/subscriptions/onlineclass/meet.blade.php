@extends('site.app', [
    'title' => 'Suivre une online class',
    'active' => 'online-classrooms'
])
@section('content')
    @if($ready)
        <div>
            <div class="max-w-sm bg-etudes-blue mx-auto py-3 text-center text-xl text-white sticky top-20">
                Token <span class="p-1 text-white bg-etudes-orange rounded px-2 font-bold">{{Auth::user()->token}}</span>
            </div>
            {!! html_entity_decode($onlineClass->script) !!}
        </div>
    @else
        <div class="mt-4">
            <div class="flex max-w-md mx-auto my-5 justify-center items-center text-etudes-orange text-xl font-semibold bg-etudes-blue mt-2 p-4 rounded-lg" data-countdown="{{$onlineClass->date.' '.$onlineClass->hour}}">
        </div>
        <div class="max-w-3xl mx-auto relative">
            <img src="{{$onlineClass->getFirstMediaUrl('onlineClass')}}" alt="">
        </div>
    @endif
@endsection
