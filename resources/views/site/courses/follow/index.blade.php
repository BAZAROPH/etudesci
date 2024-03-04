@extends('site.app', [
    'title' => $course->title,
    'active' => 'courses',
])

@section('content')
<div class="mb-16">
    <div class="h-56 bg-etudes-blue">
        <div class="md:mx-10 p-2 md:p-10 text-3xl md:text-5xl text-white grid place-items-center h-full">
            <div class="text-left w-full">
                <div class="font-semibold text-4xl line-clamp-2">{{$course->title}}</div>
                <div class="h-10 bg-etudes-orange mt-4 rounded-lg flex items-center justify-left text-sm px-4 gap-4">
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
    <div id="app" class="">

    </div>
</div>

<script type="text/javascript">
    var ROOT_URL = "{{ route('home') }}";
    var APP_NAME = "{{ config('app.name', 'Etudes.ci') }}";
    localStorage.setItem('token', "{{ session()->get('token') }}");
</script>
@vite('resources/js/courses/App.jsx')
@endsection
