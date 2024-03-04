@extends('site.app', [
    'title' => $course->title,
    'active' => 'courses',
])

@section('content')
@if ($success)
    <div class="my-6">
        <div class="text-center text-xl font-bold italic mt-2 text-etudes-blue">
            {{$course->title}}
        </div>

        <div class="max-w-6xl mx-auto rounded-lg mt-6">

            <div class="text-center text-white font-bold bg-green-600 py-3 w-full rounded-lg mb-2">
                <div class="">
                    Félicitation vous avez réussi votre test avec succès !
                </div>
                <div class="pt-2">
                    <span class="px-2 py-3 pt-4 bg-white text-green-600 rounded-0 rounded-lg">
                        Score: {{$test->score}} % <i class="icofont-thumbs-up text-3xl"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="max-w-md mx-auto text-white text-center text-xl py-2 rounded-xl my-4">
            <a href="{{route('certificate', ['slug'=>$course->slug, 'test_id'=>$test->id])}}">
                <button class="w-full italic hover:scale-110 font-bold duration-300 hover:bg-etudes-orange h-full bg-etudes-blue py-2 rounded-lg">
                    Télécharger mon attestation
                </button>
            </a>
        </div>
        <div class="mb-5 max-w-6xl mx-auto border border-green-600 p-4 rounded-lg shadow shadow-green-600">
            <div class="mx-4 md:grid md:grid-cols-2 md:gap-10 {{($blocked) ? 'select-none' : ''}}">
                @foreach ($questions as $question)
                <input type="hidden" name="course_slug" value="{{$course->slug}}">
                <div class="">
                        <div class="">
                            <span class="font-semibold text-lg text-etudes-blue">{{$loop->index+1}} - </span>
                            <span class="text-xl font-bold italic text-etudes-orange">
                                {{$question->question}}
                            </span>
                        </div>
                        <div class="pl-4 my-2">
                            <div class="justify-left items-center space-x-2">
                                <span class="italic font-semibold text-etudes-blue">Réponse :</span> <span class="px-4 py-1 rounded-xl bg-green-600 text-white">{{$question->response}}</span>
                            </div>
                        </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="my-10 max-w-6xl mx-auto border border-etudes-blue p-4 rounded-lg shadow shadow-etudes-blue">
        <div class="max-w-md mx-auto bg-etudes-blue text-white text-center text-xl py-2 rounded-xl">
            Teste sur la online classroom
        </div>
        <div class="text-center text-sm mt-2 text-etudes-blue">
            {{$course->title}}
        </div>

        <div class="mt-6">
                @error('message')
                    <div class="text-center text-white font-bold bg-red-600 py-2 w-full rounded-lg mx-2 mb-2">
                        <div>
                            {{$message}}
                        </div>
                        <div class="pt-2">
                            <span class="px-2 py-1 bg-white text-red-600 rounded-0">
                                Score: {{$errors->first('score')}} %
                            </span>
                        </div>
                    </div>
                @enderror
                @if ($blocked and $errors->first('score') == '')
                    <div class="text-center text-white font-bold bg-red-600 py-2 w-full rounded-lg mx-2 mb-2">
                        <div>
                            Désolé, vous avez eu moins de 60% des réponses correctes. Veuillez réessayer à {{$until}}
                        </div>
                        <div class="pt-2">
                            <span class="px-2 py-1 bg-white text-red-600 rounded-0">
                                Score: {{$score}} %
                            </span>
                        </div>
                    </div>
                @endif
            <form action="{{route('course.test.save', $course->slug)}}" method="post" class="">
                @csrf
                <div class="mx-4 md:grid md:grid-cols-2 md:gap-10 {{($blocked) ? 'select-none' : ''}}">
                    @foreach ($questions as $question)
                    <input type="hidden" name="course_slug" value="{{$course->slug}}">
                    <div class="">
                            <div class="">
                                <span class="font-semibold text-lg text-etudes-blue">{{$loop->index+1}} - </span>
                                <span class="text-xl font-bold italic text-etudes-orange">
                                    {{$question->question}}
                                </span>
                            </div>
                            <div class="pl-4 my-2">
                                <div class="justify-left items-center space-x-2">
                                    <input @disabled($blocked or $success)  type="radio" value="1" class="accent-etudes-blue" name="choice_{{$loop->index+1}}">
                                    <span>{{$question->response_1}}</span>
                                </div>
                                <div class="justify-left items-center space-x-2">
                                    <input @disabled($blocked or $success) type="radio" value="2" class="accent-etudes-blue" name="choice_{{$loop->index+1}}">
                                    <span>{{$question->response_2}}</span>
                                </div>
                                <div class="justify-left items-center space-x-2">
                                    <input @disabled($blocked or $success) type="radio" value="3" class="accent-etudes-blue" name="choice_{{$loop->index+1}}">
                                    <span>{{$question->response_3}}</span>
                                </div>
                            </div>
                    </div>
                    @endforeach
                </div>
                @if (!($blocked) and !($success))
                    <div class="text-center">
                        <button class="text-white bg-etudes-blue p-2 md:w-1/6 rounded-lg hover:w-full duration-300 transiton-all ease-in-out hover:bg-etudes-orange hover:font-semibold">Soumettre mon test</button>
                    </div>
                @endif
            </form>
        </div>

    </div>
@endif
@endsection
