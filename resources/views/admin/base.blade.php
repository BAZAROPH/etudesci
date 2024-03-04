<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Etudes-ci
        @isset($title)
            - {{$title}}
        @endisset
    </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('site/assets/logo-icon-blue.png')}}">
    <link href="{{asset('admin/assets/vendor/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/chartist/css/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('icofont/icofont.min.css')}}">
    <link href="{{asset('admin/assets/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendor/summernote/summernote.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/assets/vendor/select2/css/select2.min.css')}}">


    <link href="{{asset('admin/assets/css/customize.css')}}" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="{{route('home')}}" class="brand-logo">
                <img class="logo-abbr" src="{{asset('admin/assets/images/logo.png')}}" alt="">
                <img class="logo-compact" src="{{asset('admin/assets/images/logo-text.png')}}" alt="">
                <span class="ml-3">Etudes.ci</span>
            </a>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong> Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <a href="{{route('logout')}}" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Déconnexion </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Menu Principal</li>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li class="{{$active=='home' ? 'mm-active' : ''}}"><a href="{{route('admin.dashboard')}}" >
                        <i class="icofont-dashboard-web"></i><span class="nav-text">Tableau de bord</span></a>
                    </li>


                    <li class="{{$active=='payments-list' ? 'mm-active' : ''}}"><a href="{{route('admin.payment.index')}}" >
                        <i class="icofont-substitute"></i><span class="nav-text">Paiements</span></a>
                    </li>

                    <li class="{{$active=='bois-sacre' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-tree-alt"></i><span class="nav-text">Bois Sacré</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='subscription' ? 'mm-active' : ''}}" href="{{route('admin.subscription.index')}}">Abonnements</a></li>
                            <li><a class="{{$subActive=='subscribers' ? 'mm-active' : ''}}" href="{{route('admin.subscriber.index')}}">Abonnés</a></li>
                            <li><a class="{{$subActive=='potential-subscribers-list' ? 'mm-active' : ''}}" href="{{route('admin.potentialSubscribers.index')}}">Potentiels Abonnés</a></li>
                            <li><a class="{{$subActive=='online-class' ? 'mm-active' : ''}}" href="{{route('admin.onlineClass.create')}}">Onlines Classroom</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='partners' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-handshake-deal"></i><span class="nav-text">Partenariats</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='partners-list' ? 'mm-active' : ''}}" href="{{route('admin.partner.index')}}">Liste de demandes</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Entités</li>
                    <li class="{{$active=='authors' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-man-in-glasses"></i><span class="nav-text">Auteurs</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='authors-type' ? 'mm-active' : ''}}" href="{{route('admin.author.type.index')}}">Nouveau Type</a></li>
                            <li><a class="{{$subActive=='new-author' ? 'mm-active' : ''}}" href="{{route('admin.author.create')}}">Nouvel auteur</a></li>
                            <li><a class="{{$subActive=='authors-list' ? 'mm-active' : ''}}" href="{{route('admin.author.index')}}">Liste des auteurs</a></li>
                            <li><a class="{{$subActive=='authors-trash' ? 'mm-active' : ''}}" href="{{route('admin.author.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="{{$active=='accreditassions' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-paper"></i><span class="nav-text">Accréditations</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-accreditassion' ? 'mm-active' : ''}}" href="{{route('admin.accreditassion.create')}}">Nouvelle accréditation</a></li>
                            <li><a class="{{$subActive=='accreditassions-list' ? 'mm-active' : ''}}" href="{{route('admin.accreditassion.index')}}">Liste des accréditation</a></li>
                            <li><a class="{{$subActive=='accreditassions-trash' ? 'mm-active' : ''}}" href="{{route('admin.accreditassion.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="{{$active=='offices' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-ui-home"></i><span class="nav-text">Cabinets</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-office'? 'mm-active' : ''}}" href="{{route('admin.office.create')}}">Nouveau cabinet</a></li>
                            <li><a class="{{$subActive=='offices-list' ? 'mm-active' : ''}}" href="{{route('admin.office.index')}}">Liste des cabinets</a></li>
                            <li><a class="{{$subActive=='offices-trash' ? 'mm-active' : ''}}" href="{{route('admin.office.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="{{$active=='trainers' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-business-man-alt-1"></i><span class="nav-text">Formateurs</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-trainer'? 'mm-active' : ''}}" href="{{route('admin.trainer.create')}}">Nouveau formateur</a></li>
                            <li><a class="{{$subActive=='trainers-list'? 'mm-active' : ''}}" href="{{route('admin.trainer.index')}}">Liste des formateurs</a></li>
                            <li><a class="{{$subActive=='trainers-trash'? 'mm-active' : ''}}" href="{{route('admin.trainer.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="{{$active=='organizers' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-building-alt"></i><span class="nav-text">Organisateurs</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-organizer'? 'mm-active' : ''}}" href="{{route('admin.organizer.create')}}">Nouvel organisateur</a></li>
                            <li><a class="{{$subActive=='organizers-list'? 'mm-active' : ''}}" href="{{route('admin.organizer.index')}}">Liste des organisateurs</a></li>
                            <li><a class="{{$subActive=='organizers-trash'? 'mm-active' : ''}}" href="{{route('admin.organizer.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Contenu</li>
                    <li class="{{$active=='articles' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-newspaper"></i><span class="nav-text">Articles</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='articles-type'? 'mm-active' : ''}}" href="{{route('admin.article.type.index')}}">Nouveau Type</a></li>
                            <li><a class="{{$subActive=='new-article'? 'mm-active' : ''}}" href="{{route('admin.article.create')}}">Nouvel article</a></li>
                            <li><a class="{{$subActive=='articles-list'? 'mm-active' : ''}}" href="{{route('admin.article.index')}}">Liste des articles</a></li>
                            <li><a class="{{$subActive=='articles-trash'? 'mm-active' : ''}}" href="{{route('admin.article.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='courses' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-learn"></i><span class="nav-text">Cours</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-course'? 'mm-active' : ''}}" href="{{route('admin.course.create')}}">Nouveau cours</a></li>
                            <li><a class="{{$subActive=='courses-list'? 'mm-active' : ''}}" href="{{route('admin.course.index')}}">Liste des cours</a></li>
                            <li><a class="{{$subActive=='courses-trash'? 'mm-active' : ''}}" href="{{route('admin.course.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='certifications' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-graduate-alt"></i>
                        <span class="nav-text">Certifications</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-certification' ? 'mm-active' : ''}}" href="{{route('admin.certification.create')}}">Nouvelle certifications</a></li>
                            <li><a class="{{$subActive=='certifications-list'? 'mm-active' : ''}}" href="{{route('admin.certification.index')}}">Liste des certifications</a></li>
                            <li><a class="{{$subActive=='certifications-trash'? 'mm-active' : ''}}" href="{{route('admin.certification.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='events' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-score-board"></i><span class="nav-text">Évènements</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='events-type' ? 'mm-active' : ''}}" href="{{route('admin.event.type.index')}}">Nouveau Type</a></li>
                            <li><a class="{{$subActive=='new-event' ? 'mm-active' : ''}}" href="{{route('admin.event.create')}}">Nouvel évènement</a></li>
                            <li><a class="{{$subActive=='events-list' ? 'mm-active' : ''}}" href="{{route('admin.event.index')}}">Liste des évènements</a></li>
                            {{-- <li><a class="{{$subActive=='events-past' ? 'mm-active' : ''}}" href="{{route('admin.event.index')}}">Évènements passés</a></li> --}}
                            <li><a class="{{$subActive=='events-trash' ? 'mm-active' : ''}}" href="{{route('admin.event.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='books' ? 'mm-active' : ''}}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-read-book"></i><span class="nav-text">Livres & eBooks</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='new-book' ? 'mm-active' : ''}}" href="{{route('admin.book.create')}}">Nouveau livre</a></li>
                            <li><a class="{{$subActive=='books-list' ? 'mm-active' : ''}}" href="{{route('admin.book.index')}}">Liste des Livres</a></li>
                            <li><a class="{{$subActive=='books-trash' ? 'mm-active' : ''}}" href="{{route('admin.book.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>

                    <li class="{{$active=='medias' ? 'mm-active' : ''}}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-multimedia"></i><span class="nav-text">Medias</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='banners' ? 'mm-active' : ''}}" href="{{route('admin.banners.index')}}">Bannières</a></li>
                        </ul>
                    </li>

                    <li class="nav-label">Paramètres</li>
                    <li class="{{$active=='domaines' ? 'mm-active' : ''}}">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-investigation"></i><span class="nav-text">Domaines</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='domaines-type' ? 'mm-active' : ''}}" href="{{route('admin.domaine.type.index')}}">Nouveau Type</a></li>
                            <li><a class="{{$subActive=='domaines-list' ? 'mm-active' : ''}}" href="{{route('admin.domaine.index')}}">Liste des domaines</a></li>
                            <li><a class="{{$subActive=='domaines-trash' ? 'mm-active' : ''}}" href="{{route('admin.domaine.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Personnel</li>
                    <li class="{{$active=='users' ? 'mm-active' : ''}}"><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="icofont-users-alt-4"></i><span class="nav-text">Utilisateur</span></a>
                        <ul aria-expanded="false">
                            <li><a class="{{$subActive=='users-list' ? 'mm-active' : ''}}" href="{{route('admin.user.index')}}">Liste des utilisateurs</a></li>
                            <li><a class="{{$subActive=='users-trash' ? 'mm-active' : ''}}" href="{{route('admin.user.trash')}}">Corbeille</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © mayacom agency &amp; Developed by <a href="#" target="_blank">coulibaly cheick oumar</a> 2022</p>
                <p>Distributed by <a href="https://mayacom.agency/" target="_blank">Mayacom Agency</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('admin/assets/vendor/global/global.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/quixnav-init.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom.min.js')}}"></script>

    <script src="{{asset('admin/assets/vendor/chartist/js/chartist.min.js')}}"></script>

    <script src="{{asset('admin/assets/vendor/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/pg-calendar/js/pignose.calendar.min.js')}}"></script>


    <script src="{{asset('admin/assets/js/dashboard/dashboard-2.js')}}"></script>

     <!-- Datatable -->
     <script src="{{asset('admin/assets/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
     <script src="{{asset('admin/assets/js/plugins-init/datatables.init.js')}}"></script>

     <!-- Summernote -->
    <script src="{{asset('admin/assets/vendor/summernote/js/summernote.min.js')}}"></script>
    <!-- Summernote init -->
    <script src="{{asset('admin/assets/js/plugins-init/summernote-init.js')}}"></script>

     <script>
        let fileBlock = document.getElementById('file-block');
        let imageInput = document.getElementById('image-input');
        let uploadLabel = document.getElementById('upload-label');

        const handleImage = (e)=>{
            if(e.target.files[0]){
                const image = URL.createObjectURL(e.target.files[0]);
                uploadLabel.classList.add('d-none');
                document.getElementById('image-preview').src = image;
                document.getElementById('delete-icon').classList.remove('d-none');
            }
        }

        const dropImage = ()=>{
            imageInput.value = '';
            uploadLabel.classList.remove('d-none');
            document.getElementById('image-preview').src = '';
            document.getElementById('delete-icon').classList.add('d-none');
        }
    </script>

    <script>
        const uploadDocLabel = document.getElementById('upload-doc-label');
        const docPreviewBlock = document.getElementById('doc-preview-block');
        const deleteBlock = document.getElementById('delete-block');
        const handleDocs = (e)=>{
            if(e.target.files.length > 0){
                const filePreview = document.getElementById('file-preview');
                for(i=0; i<e.target.files.length; i++){
                    let middle = filePreview.cloneNode(true);
                    middle.id = 'file';
                    middle.classList.remove('d-none');
                    middle.children[0].children[2].innerHTML = e.target.files[i].name
                    docPreviewBlock.appendChild(middle);
                }
                docPreviewBlock.classList.remove('d-none')
                deleteBlock.classList.remove('d-none')
                uploadDocLabel.classList.add('d-none')
            }
        }

        const dropDocs = ()=>{
            let DocsInput = document.getElementById('docs-input');
            DocsInput.value = '';
            docPreviewBlock.classList.add('d-none')
            deleteBlock.classList.add('d-none')
            uploadDocLabel.classList.remove('d-none')
            while (document.getElementById('file')) {
                document.getElementById('file').parentNode.removeChild(document.getElementById('file'));
            }
        }

        const docPreviewBlockUpdate = document.getElementById('doc-preview-block-update');
        const deleteBlockUpdate = document.getElementById('delete-block-update');
        const uploadDocLabelUpdate = document.getElementById('upload-doc-label-update');


        const handleDocs = (e)=>{
            if(e.target.files.length > 0){
                const filePreview = document.getElementById('file-preview-update');
                for(i=0; i<e.target.files.length; i++){
                    let middle = filePreview.cloneNode(true);
                    middle.id = 'file-update';
                    middle.classList.remove('d-none');
                    middle.children[0].children[2].innerHTML = e.target.files[i].name
                    docPreviewBlock.appendChild(middle);
                }
                docPreviewBlockUpdate.classList.remove('d-none')
                deleteBlockUpdate.classList.remove('d-none')
                uploadDocLabelUpdate.classList.add('d-none')
            }
        }

        const dropDocsUpdate = ()=>{
            let DocsInputUpdate = document.getElementById('docs-input-update');
            DocsInputUpdate.value = '';
            docPreviewBlockUpdate.classList.add('d-none')
            deleteBlockUpdate.classList.add('d-none')
            uploadDocLabelUpdate.classList.remove('d-none')
            while (document.getElementById('file-update')) {
                document.getElementById('file-update').parentNode.removeChild(document.getElementById('file-update'));
            }
        }


    </script>

    <!-- Circle progress -->

    <script src="{{asset('admin/assets/vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/plugins-init/select2-init.js')}}"></script>

</body>

</html>
