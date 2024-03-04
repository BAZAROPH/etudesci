@extends('site.app', [
    'title' => 'Paiement',
    'active' => 'subscription-description',
])

@section('content')
<div class="py-10 bg-gradient-to-r from-etudes-blue/[.2] to-etudes-orange/[.1]">
    <div class="bg-white max-w-2xl mx-auto rounded pb-4">
        <div class=" py-4 text-center font-bold text-white italic text-2xl">
            <span class="bg-etudes-blue px-2 py-1">
               Achat {{$type == 'certification' ? 'de Formation' : 'd\'Évènement professionnel'}}
            </span>
            <div class="text-etudes-blue pt-2 ">{{$product['label']}}</div>
        </div>
        <hr class="border-2 border-etudes-blue">
        @if(!Auth::check())

            <div class="mt-4 mx-2 md:mx-8">
                <div class="h-10 border rounded-lg flex items-center justify-between">
                    <input type="text" class="h-full bg-transparent w-3/4 border-r rounded-l-lg px-2 focus:outline-none focus:border focus:border-etudes-blue" placeholder="Code promotionel">
                    <button class="w-1/4 h-full hover:bg-etudes-blue hover:font-bold hover:text-white hover:uppercase hover:italic rounded-r-lg duration-300">Appliquer</button>
                </div>
            </div>
            <div class="max-w-sm mx-auto flex justify-center items-center border mt-4">
                <button class="py-2 text-lg font-semibold w-full duration-500 transition-all ease-in-out" id="connexion">Connexion</button>
                <button class="py-2 text-lg font-semibold payment-authtab-active w-full duration-500 transition-all ease-in-out" id="inscription">Inscription</button>
            </div>


            <form action="{{route('subcription.login')}}" method="post" id="login-form" class="hidden">
                @csrf
                <div id="login" class="mx-2 md:mx-8 p-2 mt-6 md:grid md:grid-cols-2 gap-4 border rounded-lg">
                    <div class="my-4 w-full text-center col-span-2 hidden" id="login-error">
                        <div class="bg-red-500/[.3] py-2 rounded-xl text-red-600"></div>
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Email</label><br>
                        <input id="login-email" type="email" name="email" class="border w-full py-1 rounded-lg px-2 focus:outline-none focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Mot de passe</label><br>
                        <input id="login-password" type="password" name="email" class="border w-full py-1 rounded-lg px-2 focus:outline-none focus:border-etudes-orange">
                    </div>
                    <div class="col-span-2 text-center mt-2">
                        <button id="login-button" type="button" class="w-full rounded py-1 bg-etudes-blue text-white hover:font-bold text-lg hover:uppercase hover:italic hover:bg-etudes-orange duration-500">Se Connecter</button>
                    </div>
                </div>
            </form>


            <form action="{{route('subcription.register')}}" method="post" id="register-form">
                @csrf
                <div id="register" class="mx-2 md:mx-8 p-2 mt-6 md:grid md:grid-cols-2 gap-4 border rounded-lg">
                    <div class="my-4 w-full text-center col-span-2 hidden" id="register-error">
                        <div class="bg-red-500/[.3] py-2 rounded-xl text-red-600"></div>
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Nom</label><br>
                        <input id="last-name" type="text" name="last_name" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Prénom</label><br>
                        <input id="first-name" type="text" name="first_name" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Email</label><br>
                        <input id="register-email" type="email" name="email" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Confirmez votre email</label><br>
                        <input id="confirm-email" type="email" name="confirmEmail" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Mot de passe</label><br>
                        <input id="register-password" type="password" name="password" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange">
                    </div>
                    <div class="">
                        <label class="text-sm text-gray-500" for="">Confirmez votre mot de passe</label><br>
                        <input id='confirm-password' type="password" name="confirm_password" class="border w-full mt-1 py-1 rounded-lg px-2 focus:outline-none focus:border focus:border-etudes-orange ">
                    </div>
                    <div class="col-span-2 text-center mt-2">
                        <button id="register-button" type="button" class="w-full rounded py-1 bg-etudes-blue text-white hover:font-bold text-lg hover:uppercase hover:italic hover:bg-etudes-orange duration-500">S'incrire</button>
                    </div>
                </div>
            </form>
        @endif

        @if(Auth::check())

        <div class="border mt-6 p-2 mx-2 md:mx-8 rounded-lg">
            <div>
                <img src="{{asset('site/assets/logo-icon-blue.png')}}" class="h-12 mx-auto" alt="">
            </div>
            <div class="mx-2 md:mx-8 mt-4 space-y-4">
                <div class="my-4 w-full text-center col-span-2 hidden" id="contact-error">
                    <div class="bg-red-500/[.3] py-2 rounded-xl text-red-600"></div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="w-1/4 md:w-1/2 font-semibold">
                        Email
                    </div>
                    <div class="w-3/4 md:w-1/2">
                        <span class="px-2 py-1 font-bold text-etudes-blue text-base" id='user-email'>{{Auth::user()->email}}</span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="w-1/4 md:w-1/2 font-semibold">
                        Nom
                    </div>
                    <div class="w-3/4 md:w-1/2">
                        <span class="px-2 py-1 font-bold text-etudes-blue text-base" id='user-last_name'>{{Auth::user()->last_name}}</span>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="w-1/4 md:w-1/2 font-semibold">
                        Prénom
                    </div>
                    <div class="w-3/4 md:w-1/2">
                        <span class="px-2 py-1 font-bold text-etudes-blue text-base" id='user-first_name'>{{Auth::user()->first_name}}</span>
                    </div>
                </div>
                @if(is_null(Auth::user()->contact))
                    <div class="flex justify-between items-center">
                        <div class="w-1/4 md:w-1/2 font-semibold">
                            Contact
                        </div>
                        <div class="w-3/4 md:w-1/2">
                            <input id="contact" name="contact" type="text" class="border rounded-lg focus:rounded-none px-2 py-1 border-gray-300 focus:outline-none focus:font-bold italic focus:bg-etudes-blue focus:text-white duration-500 transition-all ease-in-out">
                        </div>
                    </div>
                @else
                    <div class="flex justify-between items-center">
                        <div class="w-1/4 md:w-1/2 font-semibold" >
                            Contact
                        </div>
                        <div class="w-3/4 md:w-1/2">
                            <span class="px-2 py-1 font-bold text-etudes-blue text-base" id="contact-value">{{Auth::user()->contact}}</span>
                        </div>
                    </div>
                @endif
                <div class="text-center pt-2">
                    <span class="font-semibold">Montant: </span>
                    @if(!is_null(Auth::user()->Subscription) && !is_null(Auth::user()->Subscription->references) && Auth::user()->Subscription->end >= $now)
                        <span class="text-etudes-orange font-bold italic text-xl pl-2">
                            <i class="icofont-star"></i> @money($product['premium_price']) <i class="icofont-star"></i>
                            <input type='hidden' id='amount' value="{{$product['premium_price']}}"/>
                        </span>
                    @else
                        <span class="text-etudes-blue font-bold italic text-xl pl-2">
                            @money($product['price'])
                            <input type='hidden' id='amount' value="{{$product['price']}}"/>
                        </span>
                    @endif
                </div>
                <div class="flex flex-wrap justify-center md:justify-between items-center gap-6 md:gap-2">
                    <div class="flex items-center gap-2">
                        <input value="OMCIV2" checked type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method" id="payment-method">
                        <img src="{{asset('site/assets/subscriptions/money/OM.png')}}" class="h-8" id="payment-method" alt="">
                    </div>
                    <div class="flex items-center gap-2">
                        <input value="FLOOZ" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/moov.png')}}" class="h-8" id="payment-method" alt="">
                    </div>
                    <div class="flex items-center gap-2">
                        <input value="MOMOCI" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/mtn.png')}}" class="h-8" id="payment-method" alt="">
                    </div>
                    <div class="flex items-center gap-2">
                        <input value="WAVECI" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/wave.png')}}" class="h-8" id="payment-method" alt="">
                    </div>
                    {{-- <div class="flex items-center gap-2">
                        <input value="PAYPAL" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/paypal.png')}}" class="h-8" id="payment-method" alt="">
                    </div> --}}
                    <div class="flex items-center gap-2">
                        <input value="CARD" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/visa.png')}}" class="h-5" alt="">
                    </div>
                    <div class="flex items-center gap-2">
                        <input value="CARD" type="radio" class="checked:accent-etudes-blue cursor-pointer" name="method">
                        <img src="{{asset('site/assets/subscriptions/money/mastercard.png')}}" class="h-8" id="payment-method" alt="">
                    </div>
                    <input type="hidden" value="{{Auth::user()->id}}" name="id" id="user">

                </div>
                <div class="text-center">
                    <button id='pay-button' class="bg-etudes-blue text-white px-3 rounded font-bold italic py-1 w-full md:w-1/6 hover:w-full duration-300">Payer</button>
                </div>
            </div>
        </div>

        @else
            <div class="border mt-6 p-2 mx-8 rounded-lg">
                <div>
                    <img src="{{asset('site/assets/logo-icon-blue.png')}}" class="h-12 mx-auto" alt="">
                </div>
                <div class="text-center py-4">
                    <i class="icofont-ui-lock text-7xl text-gray-400"></i>
                </div>
                <div class="text-center font-semibold text-gray-600 max-w-sm mx-auto">
                    Veuillez vous connecter ou créer un compte afin de continuer le paiement <i class="icofont-warning text-lg text-yellow-500"></i>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
var ROOT_URL = "{{ url('/') }}";
var TYPE = "{{$type}}"
var SLUG = "{{$product['slug']}}"
</script>
<script src="{{asset('site/assets/js/payment.js')}}"></script>
<script src="https://www.paiementpro.net/webservice/onlinepayment/js/paiementpro.v1.0.2.js"></script>
@endsection
