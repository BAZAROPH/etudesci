@extends('admin.base', [
    'title' => 'Type d\'auteurs',
    'active' => 'authors',
    'subActive' => 'authors-type'
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
                <h4 class="card-title">Liste des types d'auteurs</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter un type d'auteur</button>
                <!-- ADD Modal -->
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer un nouveau type d'auteurs</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.author.type.store')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label for="" class="text-primary required">Libellé</label>
                                    <input class="form-control form-control-lg" type="text" name="label" placeholder="">
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
                                <th>Libellé</th>
                                <th>Date de création</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $type)
                                <tr class="text-center">
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->label}}</td>
                                    <td>{{$type->date}}</td>
                                    <td>
                                        <button data-toggle="modal" data-target="#updateModal{{$type->id}}" class="btn btn-success text-white">Modifier</button>
                                        <!-- UPDATE Modal -->
                                        <div class="modal fade" id="updateModal{{$type->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Créer un nouveau type d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.author.type.update')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body text-left">
                                                            <label for="" class="text-primary required">Libellé</label>
                                                            <input class="form-control form-control-lg" type="text" value="{{$type->label}}" name="label" placeholder="">
                                                            <input type="hidden" name="id" value="{{$type->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$type->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$type->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un type d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.author.type.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$type->id}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Celle ci supprimera tous les auteurs liés à ce type !
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
                                <th>Libellé</th>
                                <th>Date de création</th>
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

