<footer class="p-10 md:p-20 bg-etudes-blue text-white font-light">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v14.0" nonce="t0Pc7MTA"></script>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
        <div>
            <div>
                <img src="{{asset('site/assets/white-logo-2.png')}}" class="h-20" alt="">
            </div>
            <div class="mt-2">
                <p class="text-gray-300 leading-6 text-sm my-4">
                    Rendez possibles vos rêves professionnels les plus fous, en ayant accès à l'information de qualité, utile au renforcement de vos capacités professionnelles.
                </p>
            </div>
            <div class="mt-4 flex justify-left items-center gap-4">
                <a href="https://www.facebook.com/etudesci" target="_blank">
                    <button class="text-xl px-2.5 p-1.5 rounded-lg bg-[#4267B2] hover:scale-150 duration-300">
                        <i class="icofont-facebook"></i>
                    </button>
                </a>
                <a href="http://linkedin.com/https://www.linkedin.com/company/etudesci" target="_blank">
                    <button class="text-xl px-2.5 p-1.5 rounded-lg bg-[#0077B5] hover:scale-150 duration-300">
                        <i class="icofont-linkedin"></i>
                    </button>
                </a>
                <a href="https://www.youtube.com/@Etudesci" target="_blank">
                    <button class="text-xl px-2.5 p-1.5 rounded-lg bg-[#FF0000] hover:scale-150 duration-300">
                        <i class="icofont-youtube-play"></i>
                    </button>
                </a>
                <a href="https://twitter.com/etudesci"  target="_blank">
                    <button class="text-xl px-2.5 p-1.5 rounded-lg bg-[#1DA1F2] hover:scale-150 duration-300">
                        <i class="icofont-twitter"></i>
                    </button>
                </a>
            </div>
        </div>

        <div>
            <div class="text-lg font-bold">Etudes.ci sur Facebook</div>
            <div class="mt-4">
                <div class="fb-page" data-href="https://www.facebook.com/etudes.ci/" data-tabs="timeline" data-width="" data-height="280" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/etudes.ci/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/etudes.ci/">Etudes.ci</a>
                    </blockquote>
                </div>
            </div>
        </div>

        <div>
            <div class="text-lg font-bold ">Liens rapides</div>
            <ul class="mt-4 space-y-4 text-gray-300">
                <li class="hover:text-white duration-300">
                    <a href="{{route('course.list')}}">
                        <i class="icofont-link"></i> Cours gratuits
                    </a>
                </li>
                {{-- <li class="hover:text-white duration-300">
                    <a href="{{route('office.list')}}">
                        <i class="icofont-link"></i> Les cabinets de formation
                    </a>
                </li> --}}
                <li class="hover:text-white duration-300">
                    <a href="{{route('certification.list')}}">
                        <i class="icofont-link"></i> Certificats
                    </a>
                </li>
                <li class="hover:text-white duration-300">
                    <a href="{{route('event.list')}}">
                        <i class="icofont-link"></i> Évènements professionnelles
                    </a>
                </li>
                <li class="hover:text-white duration-300">
                    <a href="{{route('article.list')}}">
                        <i class="icofont-link"></i> Articles
                    </a>
                </li>
                {{-- <li class="hover:text-white duration-300">
                    <a href="">
                        <i class="icofont-link"></i> Ebooks et Livres
                    </a>
                </li> --}}
            </ul>
        </div>

        <div>
            <div class="text-lg font-bold">Abonnez vous à la Newsletter</div>
            <div class="mt-4">
                <form action="https://crm.etudes.ci/form/submit?formId=5" method="post" enctype="multipart/form-data" class="text-etudes-blue space-y-6">
                    <div>
                        <input type="text" name="mauticform[nom_et_prenoms]" class="rounded w-full py-1 px-2 focus:outline-none" class="font-semibold" placeholder="Nom et Prénom(s)">
                    </div>
                    <div>
                        <input type="email" name="mauticform[email]" class="rounded w-full py-1 px-2 focus:outline-none" class="font-semibold" placeholder="Email">
                    </div>
                    <div>
                        <select name="mauticform[niveau_detude]" value="Niveau d'étude" class="bg-white w-full p-2 rounded">
                            <option value="autre">Autres niveau d'étude</option>
                            <option value="lycee">Lycée</option>
                            <option value="bac">BAC</option>
                            <option value="bts">BTS</option>
                            <option value="licence">LICENCE</option>
                            <option value="master">MASTER</option>
                            <option value="doctorat">DOCTORAT</option>
                        </select>
                    </div>
                    <div>
                        <select id="mauticform_input_newsletteretudesci_domaine" name="mauticform[domaine]" value="Domaine" class="bg-white w-full p-2 rounded">
                            <option value="aucun">Aucun domaine</option>
                            <option value="agroalimentaire">Agroalimentaire</option>
                            <option value="banque_assurance">Banque / Assurance</option>
                            <option value="bois_papier_imprimerie">Bois / Papier / Imprimerie</option>
                            <option value="btp_construction">BTP / Construction</option>
                            <option value="chimie_parachimie">Chimie / Parachimie</option>
                            <option value="commerce_distribution">Commerce / Distribution</option>
                            <option value="edition_communication_multimedia">Edition / Communication / Multimédia</option>
                            <option value="electronique_electricite">Electronique / Eléctricité</option>
                            <option value="etudes_conseils">Études et conseils</option>
                            <option value="industrie_pharmaceutique">Industrie pharmaceutique</option>
                            <option value="informatique_telecoms">Informatique / Télécoms</option>
                            <option value="mecanique_automobile">Mécanique / Automobile</option>
                            <option value="metallurgie_travail_metal">Métallurgie / Travail du métal</option>
                            <option value="plastique_caoutchouc">Plastique / Caoutchouc</option>
                            <option value="services_entreprises">Services aux entreprises</option>
                            <option value="mode">Mode</option>
                            <option value="transports_logistique">Transports / Logistique</option>
                        </select>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="mauticform[submit]" value="" class="bg-white px-2 py-1 rounded font-bold hover:bg-etudes-orange hover:text-white duration-300">Envoyer</button>
                    </div>
                    <input type="hidden" name="mauticform[formId]" id="mauticform_newsletteretudesci_id" value="5" />
                    <input type="hidden" name="mauticform[return]" id="mauticform_newsletteretudesci_return" value="" />
                    <input type="hidden" name="mauticform[formName]" id="mauticform_newsletteretudesci_name" value="newsletteretudesci" />
                </form>
            </div>
        </div>
    </div>
</footer>
