@extends('site.app', [
    'title' => 'Je conçois mon CV',
    'active' => 'workSpace',
])

@section('content')
<div id="app" class="">

</div>
<script type="text/javascript">
    var ROOT_URL = "{{ route('home') }}";
    var APP_NAME = "{{ config('app.name', 'Etudes.ci') }}";
    var USER_EMAIL = "{{ Auth::user()->email }}";
    localStorage.setItem('token', "{{ session()->get('token') }}");
</script>
@vite('resources/js/resumes/App.jsx')
@endsection
