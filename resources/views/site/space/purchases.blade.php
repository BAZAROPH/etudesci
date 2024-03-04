@extends('site.app', [
    'title' => 'Mes achats',
    'active' => 'purchases',
])

@section('content')
    <div class="bg-etudes-blue text-center mb-4">
        <div class="p-10 md:text-3xl">
            <span class="text-etudes-blue px-7 mdpx-10 py-4 bg-white rounded-lg font-bold">Liste des mes achats</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-sm md:max-w-6xl mx-auto my-10">
        @foreach ($payments as $payment)
            <div class=" order rounded-xl shadow-xl">
                <div class="w-full relative">
                    <img src="{{$payment['image']}}" class="h-80 w-full rounded-t-xl" alt="">
                </div>
                <div class="p-4">
                    <div class="flex justify-left items-center gap-2 text-gray-500 text-sm">
                        <div class=" gap-2 flex items-center">
                            <span>{{$payment['contact']}}</span>
                        </div>
                        <div>|</div>
                        <div>
                            <span>{{$payment['email']}}</span>
                        </div>
                    </div>
                    <div class="text-xl font-semibold text-etudes-blue mt-4 line-clamp-1">
                        {{$payment['author']}}
                    </div>
                </div>
                <a href="{{route('user.downloadInvoice', $payment['id'])}}">
                    <div class="border-gray-300 border-t p-4 text-center text-white bg-etudes-blue rounded-b-xl hover:scale-110 hover:rounded-t-xl duration-300 cursor-pointer">
                        <span class="font-bold text-xl">Télécharger le reçu</span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
