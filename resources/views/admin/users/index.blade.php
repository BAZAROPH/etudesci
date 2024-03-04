@extends('admin.base', [
    'title' => 'Liste des utilisateurs',
    'active' => 'users',
    'subActive' => 'users-list'
])

@section('content')
@if($errors->any())
    <div class="badge-danger row mb-4 p-2 rounded text-center">
            @foreach ($errors->all() as $error )
                <div class="col-12 mx-4"><i class="bi bi-exclamation-triangle-fill pr-2"></i>{{$error}}</div>
            @endforeach
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des administrateurs</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter un administrateur</button>
                <!-- ADD Modal -->
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer un nouvel administrateur</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.user.store')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <div>
                                        <label for="" class="text-primary required">Nom</label>
                                        <input value="{{old('last_name')}}" class="form-control form-control-lg" type="text" name="last_name" placeholder="">
                                    </div>
                                    <div>
                                        <label for="" class="text-primary required">Prénom</label>
                                        <input value="{{old('first_name')}}" class="form-control form-control-lg" type="text" name="first_name" placeholder="">
                                    </div>
                                    <div>
                                        <label for="" class="text-primary required">Email</label>
                                        <input value="{{old('email')}}" class="form-control form-control-lg" type="email" name="email" placeholder="">
                                    </div>
                                    <div>
                                        <label for="" class="text-primary required">Contact</label>
                                        <input value="{{old('contact')}}" class="form-control form-control-lg" type="text" name="contact" placeholder="">
                                    </div>
                                    <div>
                                        <label for="" class="text-primary required">Mot de passe</label>
                                        <input class="form-control form-control-lg" type="password" name="password" placeholder="">
                                    </div>
                                    <div class="mt-2">
                                        <input class="form-control form-control-lg" type="password" name="confirm_password" placeholder="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-center">
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->contact}}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateModal{{$user->id}}" class="btn btn-success text-white">Modifier</button>
                                        <!-- UPDATE Modal -->
                                        <div class="modal fade" id="updateModal{{$user->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Créer un nouvel administrateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.user.update')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$user->id}}">
                                                        <div class="modal-body text-left">
                                                            <div>
                                                                <label for="" class="text-primary required">Nom</label>
                                                                <input value="{{$user->last_name}}" class="form-control form-control-lg" type="text" name="last_name" placeholder="">
                                                            </div>
                                                            <div>
                                                                <label for="" class="text-primary required">Prénom</label>
                                                                <input value="{{$user->first_name}}" class="form-control form-control-lg" type="text" name="first_name" placeholder="">
                                                            </div>
                                                            <div>
                                                                <label for="" class="text-primary required">Email</label>
                                                                <input value="{{$user->email}}" class="form-control form-control-lg" type="email" name="email" placeholder="">
                                                            </div>
                                                            <div>
                                                                <label for="" class="text-primary required">Contact</label>
                                                                <input value="{{$user->contact}}" class="form-control form-control-lg" type="text" name="contact" placeholder="">
                                                            </div>
                                                            <div>
                                                                <label for="" class="text-primary required">Mot de passe</label>
                                                                <input class="form-control form-control-lg" type="password" name="password" placeholder="">
                                                            </div>
                                                            <div class="mt-2">
                                                                <input class="form-control form-control-lg" type="password" name="confirm_password" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$user->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$user->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un administrateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.user.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$user->id}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

