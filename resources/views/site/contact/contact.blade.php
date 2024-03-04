@extends('site.app', [
    'title' => 'Contactez nous',
    'active' => 'contact',
])

@section('content')
<div class="max-w-sm md:max-w-6xl my-10 md:my-20 mx-auto md:grid md:grid-cols-3 gap-4">
    <div class="p-10 bg-gradient-to-r from-etudes-blue to-etudes-orange rounded-xl mx-2 md:mx-0">
        <div>
            <img src="{{asset('site/assets/whiteicon.png')}}" class="h-20 mx-auto" alt="">
        </div>
        <div class="text-center text-white font-semibold">
            <span>Contactez nous via les cannaux suivants:</span>
        </div>
        <div>
            <ul class="md:mx-12 my-3 md:my-0 md:mt-10 space-y-4">
                <li>
                    <a class="flex justify-between items-center text-white" target="_blank" href="https://wa.me/message/NPYHB7ILSSDJD1">
                        <i class="icofont-brand-whatsapp"></i>
                        <span>+225 07 00 773 304</span>
                    </a>
                </li>
                <li>
                    <a class="flex justify-between items-center text-white" target="_blank" href="tel:+2252724309780">
                        <i class="icofont-headphone-alt-2"></i>
                        <span>+225 27 24 309 780</span>
                    </a>
                </li>
                <li>
                    <a class="flex justify-between items-center text-white" target="_blank" href="mailto:commercial@etudes.ci">
                        <i class="icofont-ui-email"></i>
                        <span>commercial@etudes.ci</span>
                    </a>
                </li>
                <li>
                    <a class="flex justify-between items-center text-white">
                        <i class="icofont-web"></i>
                        <span>www.etudes.ci</span>
                    </a>
                </li>
                <li class="flex justify-between items-center text-white">

                </li>
            </ul>
        </div>
    </div>
    <hr class="border-2 border-etudes-blue my-8 md:hidden">
    <div class="md:col-span-2">
        <div class="text-center">
            <span class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-etudes-blue to-etudes-orange">Devenez Partenaire</span>
        </div>
        <form action="{{route('contact.partner')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
                <div class="my-4 w-full text-center col-span-2 " id="login-error">
                    <div class="bg-red-500/[.3] py-2 rounded-xl text-red-600">
                        @foreach ($errors->all() as $error )
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="md:grid grid-cols-2 gap-4 border border-etudes-blue p-8 m-4 rounded-lg ">
                    <div>
                    <label for="" class="required">Nom</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="last_name">
                </div>
                <div>
                    <label for="" class="required">Prénom</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="first_name">
                </div>
                <div>
                    <label for="" class="required">Email</label>
                    <input type="mail" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="email">
                </div>
                <div>
                    <label for="" class="required">Téléphone</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="contact">
                </div>
                <div>
                    <label for="" class="">Société</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="company">
                </div>
                <div>
                    <label for="">Site web</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="website">
                </div>
                <div>
                    <label for="" class="required">Pays</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="country">
                </div>
                <div>
                    <label for="" class="required">Ville</label>
                    <input type="text" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="city">
                </div>
                <div class="col-span-2">
                    <label for="">Fichier de présentation</label>
                    <input type="file" class="py-1 px-2 border w-full rounded my-3 md:my-0 md:mt-1 focus:outline-none focus:border-etudes-blue" name="file">
                </div>
                <div class="col-span-2 text-center mt-2">
                    <button class="py-2 px-4 text-white bg-etudes-blue rounded-lg transition-all ease-in-out hover:px-20 hover:bg-etudes-orange duration-300">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
