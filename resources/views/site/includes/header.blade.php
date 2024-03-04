<header class="sticky top-0 z-50">
    <div class="shadow-lg  bg-white">
        <div class="hidden md:flex mx-8 h-20 justify-between items-center text-md font-medium text-etudes-blue ">
            <div class="">
                <a href="{{route('home')}}">
                    <img src="{{asset('site/assets/blue-logo.png')}}" class="h-9" alt="etudes.ci-logo">
                </a>
            </div>
            <div class="dropdown hover:cursor-pointer">
                <div class="uppercase py-2 "><i class="icofont-listine-dots"></i> Explorer</div>
                <div class="absolute hidden pt-4 dropdown-content">
                    <ul class="uppercase max-w-sm border-2 border-etudes-blue p-2 rounded-xl divide-y divide-etudes-blue bg-white">
                        <a href="{{route('course.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'courses' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Cours
                            </li>
                        </a>
                        {{-- <a href="{{route('office.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'offices' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Les cabinets de formation
                            </li>
                        </a> --}}
                        <a href="{{route('certification.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'certifications' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Certifications
                            </li>
                        </a>
                        <a href="{{route('event.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'events' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Évènements professionnels
                            </li>
                        </a>
                        <a href="{{route('article.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'articles' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Articles
                            </li>
                        </a>
                        <a href="{{route('book.list')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'books' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Ebooks et livres
                            </li>
                        </a>
                        <a href="{{route('contact.index')}}">
                            <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer  {{$active == 'contact' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                Contact
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="flex item-center justify-center gap-4">
                <a href="{{route('home')}}" class="uppercase hover:text-etudes-orange duration-300 hover:cursor-pointer py-2 {{$active == 'home' ? 'text-etudes-orange' : ''}}">Accueil</a>
                <a href="{{route('course.list')}}" class="uppercase hover:text-etudes-orange duration-300 hover:cursor-pointer py-2 {{$active == 'courses' ? 'text-etudes-orange' : ''}}">Cours</a>
                <div class="dropdown hover:cursor-pointer">
                    <div class="uppercase py-2 {{$active == 'certifications' || $active == 'events' ? 'text-etudes-orange' : ''}}"> Formation</div>
                    <div class="pt-4 absolute hidden  dropdown-content">
                        <ul class="uppercase max-w-sm border-2 border-etudes-blue p-2 rounded-xl divide-y divide-etudes-blue bg-white">
                            <a href="{{route('certification.list')}}">
                                <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer {{$active == 'certifications' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                    Certifications
                                </li>
                            </a>
                            <a href="{{route('event.list')}}">
                                <li class="hover:bg-etudes-blue hover:text-white py-3 hover:pl-3 hover:pr-1 duration-300 hover:cursor-pointer {{$active == 'events' ? 'bg-etudes-orange text-white pl-3 pr-1' : ''}}">
                                    Évènements professionelles
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
                <a href="">
                <a href="{{route('resume.list')}}" class="">
                    <button class="bg-etudes-blue text-white py-2 px-3 rounded-lg hover:bg-etudes-orange duration-300 hover:cursor-pointer">Créer mon CV</button>
                </a>
                <a href="{{route('subscritption.description')}}" class="">
                    <button class="bg-etudes-orange text-white py-1 px-3 rounded-lg  hover:bg-etudes-blue duration-300 hover:cursor-pointer group"><span class="font-bois text-3xl">Le Bois</span> Sacré des <span class="bg-white text-etudes-orange italic px-1 font-bold text-lg group-hover:text-etudes-blue duration-300">PROS</span></button>
                </a>
                <div class="py-1 flex items-center gap-1">
                    <input type="text" class="border py-1 rounded-lg border-gray-300 focus:border-etudes-blue duration-300 focus:outline-none px-2">
                    <i class="icofont-search-2 text-white bg-etudes-blue rounded-lg p-2"></i>
                </div>
                @if (Auth::check())
                    <div class="text-sm gap-2 flex items-center border px-1 border-dashed rounded-xl border-etudes-blue cursor-pointer" onclick="userMenuToggle()">
                        <i class="icofont-learn"></i>
                        <div class="max-w-[5.5em] truncate select-none">
                            {{Auth::user()->first_name}}
                        </div>
                    </div>
                @else
                    <a href="{{route('login.view')}}" class="uppercase py-1">
                        <button class="bg-etudes-blue text-white py-1 px-2 rounded-lg hover:bg-etudes-orange duration-300">S'identifier</button>
                    </a>
                @endif
            </div>
        </div>

        {{-- mobile-menu --}}
        <div id="mobile-menu" class="md:hidden h-sreen bg-white h-16 stiky top-0">
            <div class="flex items-center justify-between p-2 h-full">
                <div>
                    <a href="{{route('home')}}">
                        <img src="{{asset('site/assets/blue-logo.png')}}" class="h-9" alt="etudes.ci-logo">
                    </a>
                </div>
                <div class="flex items-center justify-center gap-4">
                    @if (Auth::check())
                        <div class="text-base gap-2 flex items-center px-1 py-2 text-etudes-blue font-semibold cursor-pointer">
                            <i class="icofont-learn"></i>
                            <div class="max-w-[5em] truncate select-none">
                                {{Auth::user()->first_name}}
                            </div>
                        </div>
                    @else
                        <a href="{{route('login.view')}}">
                            <button class="px-3 py-2 bg-etudes-blue text-white rounded-xl">S'identifier</button>
                        </a>
                    @endif
                    <div class="" id='menu-button' clicked='false' onclick="toggleMenu()">
                        <div id="bar-1" class="h-0.5 w-9 bg-black my-2 group-hover:bg-red-700 duration-300"></div>
                        <div id="bar-2" class="h-0.5 w-9 bg-black my-2 group-hover:bg-red-700 duration-300"></div>
                        <div id="bar-3" class="h-0.5 w-9 bg-black my-2 group-hover:bg-red-700 duration-300"></div>
                    </div>
                </div>
            </div>
            {{-- menu content --}}
            <div id='menu-content' class="text-etudes-blue bg-white font-medium divide-y h-0 overflow-hidden transition-all ease-in-out duration-500">
                <div class="uppercase py-3">
                    <div class="flex items-center justify-between">
                        <span><i class="icofont-listine-dots"></i> Explorer</span>
                        <i class="icofont-rounded-down text-2xl -rotate-90 duration-300" id='open-dropdown-icon' onclick="openDropDown()" opened='false'></i>
                    </div>
                    <ul id='dropdown-content' class="uppercase max-w-sm divide-y divide-etudes-blue text-sm ml-6 duration-300 transition-all h-0 overflow-hidden ease-in-out">
                        <a href="{{route('course.list')}}">
                            <li class="py-3 {{$active == 'courses' ? 'text-etudes-orange' : ''}}">
                                Cours
                            </li>
                        </a>
                        {{-- <a href="{{route('office.list')}}">
                            <li class="py-3 {{$active == 'offices' ? 'text-etudes-orange' : ''}}">
                                Les cabinets de formation
                            </li>
                        </a> --}}
                        <a href="{{route('certification.list')}}">
                            <li class="py-3 {{$active == 'certifications' ? 'text-etudes-orange' : ''}}">
                                Certificats
                            </li>
                        </a>
                        <a href="{{route('event.list')}}">
                            <li class="py-3 {{$active == 'events' ? 'text-etudes-orange' : ''}}">
                                Évènements professionnels
                            </li>
                        </a>
                        <a href="{{route('article.list')}}">
                            <li class="py-3 {{$active == 'articles' ? 'text-etudes-orange' : ''}}">
                                Articles
                            </li>
                        </a>
                        <a href="{{route('book.list')}}">
                            <li class="py-3 {{$active == 'books' ? 'text-etudes-orange' : ''}}">
                                Ebooks et livres
                            </li>
                        </a>
                        <a href="{{route('contact.index')}}">
                            <li class="py-3 {{$active == 'contact' ? 'text-etudes-orange' : ''}}">
                                Contact
                            </li>
                        </a>
                    </ul>
                </div>
                <div class="py-3">
                    <a href="{{route('course.list')}}" class="uppercase hover:text-etudes-orange duration-300 hover:cursor-pointer">Accueil</a>
                </div>
                <div class="py-3">
                    <a href="" class="uppercase hover:text-etudes-orange duration-300 hover:cursor-pointer {{$active == 'courses' ? 'text-etudes-orange' : ''}}">Cours</a>
                </div>
                <div class="flex justify-between items-center py-2">
                    <a href="{{route('resume.list')}}">
                        <button class="p-2 bg-etudes-blue text-white rounded-xl text-sm">Créer mon cv</button>
                    </a>
                    <a href="{{route('subscritption.description')}}" class="">
                        <button class="bg-etudes-orange text-white py-1 px-3 rounded-lg  hover:bg-etudes-blue duration-300 hover:cursor-pointer group text-sm"><span class="font-bois text-lg">Le Bois</span> Sacré des <span class="bg-white text-etudes-orange italic px-1 font-bold text-sm group-hover:text-etudes-blue duration-300">PROS</span></button>
                    </a>
                </div>
                @if(Auth::check())
                    <div class="flex justify-between items-center">
                        @if (Auth::user()->Subscription != null)
                            @if (Auth::user()->Subscription->state >= 1)
                                <a href="{{route('subscritption.space')}}">
                                    <button class="py-2 px-4 rounded-xl bg-etudes-blue text-white font-medium text-sm">Mon Espace</button>
                                </a>
                            @endif
                        @endif
                        <a href="{{route('logout')}}">
                            <div class="py-2">
                                <button class="p-2 text-gray-600 rounded-lg text-white">Déconnexion</button>
                            </div>
                        </a>
                    </div>
                    <hr>
                @endif
            </div>
        </div>
    </div>

    {{-- user menu --}}
    <div class="right-3 max-w-[14em] bg-white shadow-xl border-b border-l border-r border-gray-400 rounded-b-lg font-semibold hidden absolute divide-y divide-gray-300 select-none select-none" id= "user-menu">
        <div class="py-2 px-4 duration-300 ease-in-out transition-all cursor-pointer hover:text-white hover:bg-etudes-blue select-none">
            <a href="{{route('subscritption.space')}}">
                Mon Espace
            </a>
        </div>
        <div class="py-2 px-4 duration-300 ease-in-out transition-all cursor-pointer hover:text-white hover:bg-etudes-blue select-none">
            <a href="{{route('user.purchase')}}">
                Mes Achats
            </a>
        </div>
        @if (Auth::check() and !is_null(Auth::user()->Role))
            @if(Auth::user()->Role->label == 'admin')
                <div class="py-2 px-4 duration-300 ease-in-out transition-all cursor-pointer hover:text-white hover:bg-etudes-blue select-none">
                    <a href="{{route('admin.dashboard')}}">
                        Administration
                    </a>
                </div>
            @endif
        @endif
        <div class="py-2 px-4 duration-300 ease-in-out transition-all cursor-pointer hover:text-white hover:bg-red-600 hover:rounded-b-lg select-none">
            <a href="{{route('logout')}}">
                Déconnexion
            </a>
        </div>
    </div>
</header>

<script>
    const userMenuToggle = ()=>{
        const userMenu = document.getElementById('user-menu');
        userMenu.classList.toggle('hidden');
    }


    const mobileMenu = document.getElementById('mobile-menu');
    const menuButton = document.getElementById('menu-button');
    const menuContent = document.getElementById('menu-content');
    const bar1 = document.getElementById('bar-1');
    const bar2 = document.getElementById('bar-2');
    const bar3 = document.getElementById('bar-3');

    const openDropDownIcon = document.getElementById('open-dropdown-icon')
    const dropdownContent = document.getElementById('dropdown-content')

    const toggleMenu = ()=>{
        if(menuButton.getAttribute('clicked') == 'false'){
            menuButton.setAttribute('clicked', 'true');

            bar1.classList.add('rotate-45', 'translate-y-1.5')
            bar2.classList.add('hidden')
            bar3.classList.add('-rotate-45', '-translate-y-1')
            mobileMenu.classList.add('h-screen', 'fixed', 'inset-0')
            menuContent.classList.toggle('h-0');
            menuContent.classList.toggle('h-screen');
            menuContent.classList.toggle('p-6');
        }else{
            menuButton.setAttribute('clicked', 'false');

            bar1.classList.remove('rotate-45', 'translate-y-1.5')
            bar3.classList.remove('-rotate-45', '-translate-y-1')
            mobileMenu.classList.remove('h-screen', 'fixed', 'inset-0')
            setTimeout(() => {
                bar2.classList.remove('hidden')
            }, 100);
            // menuContent.classList.add('hidden', 'animate__fadeIn')
            menuContent.classList.toggle('h-0');
            menuContent.classList.toggle('h-screen');
            menuContent.classList.toggle('p-6');
        }
    }

    const openDropDown = ()=>{
        if(openDropDownIcon.getAttribute('opened') == 'false'){
            openDropDownIcon.setAttribute('opened', 'true');
            openDropDownIcon.classList.remove('-rotate-90');
            dropdownContent.classList.toggle('h-0');
            dropdownContent.classList.toggle('h-72');
            dropdownContent.classList.toggle('pt-4');
        }else{
            openDropDownIcon.setAttribute('opened', 'false');
            openDropDownIcon.classList.add('-rotate-90')
            dropdownContent.classList.toggle('h-0');
            dropdownContent.classList.toggle('h-72');
            dropdownContent.classList.toggle('pt-4');
        }
    }

</script>
