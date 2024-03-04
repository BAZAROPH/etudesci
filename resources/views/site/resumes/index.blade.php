@extends('site.app', [
    'title' => 'Je conçois mon CV',
    'active' => 'resume',
])

@section('content')
<div class="">
    <div id="app" class="">

    </div>
</div>
<script type="text/javascript">
    var ROOT_URL = "{{ route('home') }}";
    var APP_NAME = "{{ config('app.name', 'Etudes.ci') }}";
    localStorage.setItem('token', "{{ session()->get('token') }}");
</script>
@vite('resources/js/resumes/App.jsx')
@endsection
