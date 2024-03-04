<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - Etudes.ci</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body>
    <div class="md:grid md:grid-cols-2">
        <div class="hidden md:block">
            <img src="{{asset('site/assets/login/cover.png')}}" alt="">
        </div>
        <div class="h-screen pt-10 md:pt-0 md:grid md:place-items-center bg-etudes-blue">
            <div class="w-full">
                <div class="max-w-sm mx-auto">
                    <a href="{{route('home')}}" class="cursor-pointer">
                        <img src="{{asset('site/assets/white-logo.png')}}" class="h-16 mx-auto mb-4" alt="">
                    </a>
                </div>
                <div class="md:h-3/5 bg-white md:w-10/12 rounded-xl py-5 px-2 md:px-8 mx-2 md:mx-auto">
                    <div class="flex justify-center items-center max-w-sm mx-auto">
                        <button id="login-button" class="text-2xl font-semibold py-2 px-4 bg-etudes-blue text-white" onclick="loginView()">Connexion</button>
                        <button id="register-button" class="text-2xl font-semibold py-2 px-4 text-etudes-blue" onclick="registerView()">Inscription</button>
                    </div>
                    <div class="w-full mx-auto mt-10 grid place-items-center">
                        {{-- LOGIN --}}
                        <form action="{{route('login')}}" method="post" class="w-3/4" id="login">
                            @csrf
                            <div class="py-5 w-full bg-red-500/[.2] mb-4 rounded-xl text-center text-lg font-semibold text-red-700 hidden" id="login-error-block">
                                Email ou mot de passe incorrecte
                            </div>
                            <div class="w-full">
                                <div class="text-lg text-etudes-blue required">Email</div>
                                <div class="mt-2">
                                    <input id='login-email' name="email" type="email" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                    <small id="login-email-error" class="text-red-500 hidden">Vous devez renseigner votre adresse email !</small>
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="text-lg text-etudes-blue mt-6 required">Mot de passe</div>
                                <div class="mt-2">
                                    <input id="login-password" name="password" type="password" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                    <small id="login-password-error" name='password' class="text-red-500 hidden">Vous devez renseigner votre mot de passe !</small>
                                </div>
                            </div>

                            <div class="mt-10 text-center">
                                <button type="button" id="login-submit" class="bg-etudes-blue text-white rounded-md py-2 w-full font-semibold hover:scale-110 duration-300 hover:bg-etudes-orange" onclick="login()">Se connecter</button>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{route('reset-password')}}" class="text-sm hover:underline text-etudes-blue hover:text-etudes-orange">Mot de passe oublié ?</a>
                            </div>
                        </form>

                        {{-- REGISTER --}}

                        <form action="{{route('register')}}" class="w-full hidden" method="post" id="register">
                            @csrf
                            <div class="py-5 w-full bg-red-500/[.2] mb-4 rounded-xl text-center text-lg font-semibold text-red-700 hidden" id="register-error-block">

                            </div>
                            <div class="w-full md:grid md:grid-cols-2 gap-2">
                                <div>
                                    <div class="text-lg text-etudes-blue required">Nom</div>
                                    <div class="mt-1">
                                        <input id="register-last-name" name="last_name" type="text" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                        <small id="register-last-name-error" class="text-red-500 hidden">Vous devez renseigner votre nom !</small>
                                    </div>
                                </div>
                                <div class="mt-2 md:mt-0">
                                    <div class="text-lg text-etudes-blue required">Prénom</div>
                                    <div class="mt-1">
                                        <input id="register-first-name" name="first_name" type="text" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                        <small id="register-first-name-error" class="text-red-500 hidden">Vous devez renseigner votre prénom !</small>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full mt-3">
                                <div class="w-full ">
                                    <div>
                                        <div class="text-lg text-etudes-blue required">Email</div>
                                        <div class="mt-1">
                                            <input id="register-email" name="email" type="email" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                            <small id="register-email-error" class="text-red-500 hidden">Vous devez renseigner votre adresse email !</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full mt-3">
                                <div class="w-full md:grid md:grid-cols-2 gap-2">
                                    <div>
                                        <div class="text-lg text-etudes-blue required">Mot de passe</div>
                                        <div class="mt-1">
                                            <input id="register-password" name="password" type="password" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue required">
                                            <small id="register-password-error" class="text-red-500 hidden">Vous devez renseigner un mot de passe !</small>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-0">
                                        <div class="text-lg text-etudes-blue required">Confirmer</div>
                                        <div class="mt-1">
                                            <input id="register-confirm-password" name="confirm_password" type="password" class="border rounded-md py-1 px-2 w-full border-gray-300 focus:outline-none focus:border-etudes-blue">
                                            <small id="register-confirm-password-error" class="text-red-500 hidden">Vous devez confirmer le mot de passe !</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-10 text-center">
                                <button type="button" id="register-submit" class="bg-etudes-blue text-white rounded-md py-2 w-full font-semibold hover:scale-110 duration-300 hover:bg-etudes-orange" onclick="register()">S'inscrire</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ROOT_URL = "{{ url('/') }}";
        const registerView = ()=>{
            registerButton = document.getElementById('register-button');
            loginButton = document.getElementById('login-button');
            registerForm = document.getElementById('register');
            loginForm = document.getElementById('login');

            loginButton.classList.remove('text-white', 'bg-etudes-blue');
            loginButton.classList.add('text-etudes-blue');

            registerButton.classList.add('text-white', 'bg-etudes-blue');
            registerButton.classList.remove('text-etudes-blue');

            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');

        }

        const loginView = ()=>{
            loginButton = document.getElementById('login-button');
            registerButton = document.getElementById('register-button');

            registerButton.classList.remove('text-white', 'bg-etudes-blue');
            registerButton.classList.add('text-etudes-blue');

            loginButton.classList.add('text-white', 'bg-etudes-blue');
            loginButton.classList.remove('text-etudes-blue');

            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
        }

        function isEmail(email) {

            // Regular Expression (Not accepts second @ symbol
            // before the @gmail.com and accepts everything else)
            var regexp = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

            // Converting the email to lowercase
            return regexp.test(String(email).toLowerCase());
        }

        const login = ()=>{
            const loginEmail = document.getElementById('login-email');
            const loginPassword = document.getElementById('login-password');
            document.getElementById('login-submit').disabled = true;
            if(!loginEmail.value || !isEmail(loginEmail.value)){
                document.getElementById('login-email-error').classList.remove('hidden')
            }
            if(!loginPassword.value){
                document.getElementById('login-password-error').classList.remove('hidden')
            }

            if(loginEmail.value && loginPassword.value && isEmail(loginEmail.value)){
                const data = {
                    'email' : loginEmail.value,
                    'password' : loginPassword.value,
                }

                axios.post(`${ROOT_URL}/api/login-validation`, data)
                .then((response)=>{
                    console.log(response);
                    if(response.data.success){
                        document.getElementById('login').submit();
                    }else{
                        document.getElementById('login-error-block').classList.remove('hidden')
                    }
                })
                .catch((error)=>{
                    console.log(error);
                })
            }
            document.getElementById('login-submit').disabled = false;
        }

        const register = ()=>{
            document.getElementById('register-submit').disabled = true;
            const registerFirstName = document.getElementById('register-first-name');
            const registerLastName = document.getElementById('register-last-name');
            const registerEmail = document.getElementById('register-email');
            const registerPassword = document.getElementById('register-password');
            const registerConfirmPassword = document.getElementById('register-confirm-password');

            if(!registerFirstName.value){
                document.getElementById('register-first-name-error').classList.remove('hidden')
            }

            if(!registerLastName.value){
                document.getElementById('register-last-name-error').classList.remove('hidden')
            }

            if(!registerEmail.value || !isEmail(registerEmail.value)){
                document.getElementById('register-email-error').classList.remove('hidden')
            }

            if(!registerPassword.value){
                document.getElementById('register-password-error').classList.remove('hidden')
            }

            if(!registerConfirmPassword.value){
                document.getElementById('register-confirm-password-error').classList.remove('hidden')
            }

            if (registerFirstName.value && registerLastName.value && registerEmail.value && isEmail(registerEmail.value) && registerPassword.value && registerConfirmPassword) {
                const data = {
                    'first_name' : registerFirstName.value,
                    'last_name' : registerLastName.value,
                    'email' : registerEmail.value,
                    'password' : registerPassword.value,
                    'confirm_password' : registerConfirmPassword.value,
                }
                axios.post(`${ROOT_URL}/api/register-validation`, data)
                .then((response)=>{
                    if(!response.data.exist && response.data.password){
                        document.getElementById('register').submit();
                    }else if(response.data.exist){
                        document.getElementById('register-error-block').classList.remove('hidden')
                        document.getElementById('register-error-block').innerHTML = 'Ce compte existe déjà !'
                        document.getElementById('register-submit').disabled = false;
                    }else if(!response.data.password){
                        document.getElementById('register-error-block').classList.remove('hidden')
                        document.getElementById('register-error-block').innerHTML = 'Les mots de passe sont différents !'
                        document.getElementById('register-submit').disabled = false;
                    }
                })
                .catch((error)=>{
                    console.log(error);
                })

            }
        }
        document.getElementById('register-submit').disabled = false;
    </script>
</body>
</html>
