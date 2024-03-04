<div class="fixed top-0 left-0 w-full h-full z-50 overflow-y-auto bg-black/[.3] animate__animated hidden" id="modal" >
    <div class="relative w-11/12 mx-auto my-0 py-2 px-5 max-w-xl bg-white rounded-lg top-20 md:top-52 animate__animated" id="modal-content">
        <div class="flex justify-between items-center my-2">
            <div class="text-lg font-semibold text-etudes-blue">Veuillez vous connecter</div>
            <div>
                <i class="icofont-brand-nexus cursor-pointer hover:text-red-500 duration-300" id="close-modal-icon"></i>
            </div>
        </div>
        <div class="">
            <div class="md:h-3/5 bg-white rounded-xl py-5 px-2 md:px-8 mx-2 md:mx-auto">
                <div class="flex justify-center items-center max-w-sm mx-auto">
                    <button id="login-button" class="text-2xl font-semibold py-2 px-4 bg-etudes-blue text-white" onclick="loginView()">Connexion</button>
                </div>
                <div class="w-full mx-auto mt-10 grid place-items-center">
                    {{-- LOGIN --}}
                    <form action="{{route('login')}}" method="post" class="w-3/4" id="login">
                        @csrf
                        <input type="hidden" value="course.taken" name="redirect">
                        <input type="hidden" value="{{$course->slug}}" name="slug">
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
                            <button class="bg-etudes-blue text-white rounded-md py-2 w-full font-semibold hover:scale-110 duration-300 hover:bg-etudes-orange" onclick="login()">Se connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    const loginModalButton = document.getElementById('login-modal');
    loginModalButton.addEventListener('click', ()=>{
        document.getElementById('modal').classList.remove('hidden');
    })
    const closeModalIcon = document.getElementById('close-modal-icon');
    closeModalIcon.addEventListener('click', ()=>{
        document.getElementById('modal').classList.add('hidden');
    })
</script>
