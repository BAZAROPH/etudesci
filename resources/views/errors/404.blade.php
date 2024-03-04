@extends('site.app', [
    'title' => 'Page Introuvable',
    'active' => '404',
])

@section('content')
    <div>
        <img src="{{asset('site/404.png')}}" class="" alt="">
    </div>
@endsection
