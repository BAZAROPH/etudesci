@extends('admin.base', [
    'title' => 'Tableau de bord',
    'active' => 'home',
    'subActive' => 'home'
])

@section('content')
    <div class="row">
        <div class="col-lg-12 my-4">
            @if($errors->any())
                <div class="badge-danger row mb-4 p-2 rounded text-center">
                        @foreach ($errors->all() as $error )
                            <div class="col-12 mx-4"><i class="bi bi-exclamation-triangle-fill pr-2"></i>{{$error}}</div>
                        @endforeach
                </div>
            @endif
            <button class="btn btn-primary" data-toggle="modal" data-target="#format">Formatter des contacts</button>
            <!-- Modal -->
            <div class="modal fade" id="format" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formatter une liste de contact en CSV</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{route('admin.format-contact')}}" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="modal-body">
                                <input type="file" name="csvfile" class="form form-control">
                            </div>
                            <div class="mt-2 mx-4 mb-4">
                                <select name="type" class="form-control input-default" id="">
                                    <option value="valid">Les valides</option>
                                    <option value="invalid">Les invalides</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-primary">Formatter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{route('admin.users-emails')}}" class="mr-2">
                <button class="btn btn-warning" >Liste des emails</button>
            </a>
            <button class="btn btn-success text-white" data-toggle="modal" data-target="#email">Envoyer des emails</button>
            <!-- Modal -->
            <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Envoyer des emails personnalisés</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <form action="{{route('admin.application.send_customs_emails_to_users_list')}}" id="end-email-form" method="post" enctype="multipart/form-data" >
                            @csrf
                            <div class="modal-body">
                                <div class="col-12">
                                    <label for="code" class="required text-primary">Code de l'email</label>
                                    <textarea name="code" name="text" class="form form-control"></textarea>
                                </div>

                                <div class="mt-2 mb-4 col-12">
                                    <label for="code" class="required text-primary">Objet de l'email</label>
                                    <input type="text" class="form form-control" name="object">
                                </div>

                                <div class="mt-2 mb-4 col-12">
                                    <input type="file" class="form form-control" name="file">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                <button type="button" class="btn btn-primary" id="send-email-button">Envoyer</button>
                                <script>
                                    document.getElementById('send-email-button').addEventListener('click', ()=>{
                                        document.getElementById('send-email-button').disabled = true;
                                        document.getElementById('end-email-form').submit();
                                    })
                                </script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total des utilisateurs Lambda </div>
                        <div class="stat-digit">{{$total_users}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Utilisateurs créés aujourd'hui </div>
                        <div class="stat-digit">{{$today_users}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Utilisateurs créés cette semaine </div>
                        <div class="stat-digit">{{$week_users}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Utilisateurs créés cette mois </div>
                        <div class="stat-digit">{{$month_users}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /# column -->
</div>

<div class="row">
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Total des administrateurs</div>
                    <div class="stat-digit">{{$admin_users}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Inscris ce mois</div>
                    <div class="stat-digit"> <i class="fa fa-usd"></i> 500</div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Inscris cette année</div>
                    <div class="stat-digit"> <i class="fa fa-usd"></i>650</div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <!-- /# card -->
    </div>
    <!-- /# column -->
</div>

<div class="row">
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Nombre de livres</div>
                    <div class="stat-digit"> <i class="fa fa-usd"></i>8500</div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Nombre d'articles</div>
                    <div class="stat-digit"> <i class="fa fa-usd"></i>7800</div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-sm-6">
        <div class="card">
            <div class="stat-widget-two card-body">
                <div class="stat-content">
                    <div class="stat-text">Nombre de cabinets</div>
                    <div class="stat-digit"> <i class="fa fa-usd"></i> 500</div>
                </div>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- /# column -->
</div>


@endsection
