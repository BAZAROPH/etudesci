@extends('admin.base', [
    'title' => 'Corbeille des formateurs',
    'active' => 'tainers',
    'subActive' => 'trainers-trash'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des formateurs</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Fonction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trainers as $trainer)
                                <tr class="text-center">
                                    <td>{{$trainer->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$trainer->getFirstMediaUrl('trainers')}}" alt="">
                                    </td>
                                    <td>{{$trainer->last_name}}</td>
                                    <td>{{$trainer->first_name}}</td>
                                    <td>{{$trainer->contact}}</td>
                                    <td>{{$trainer->email}}</td>
                                    <td>{{$trainer->function}}</td>
                                    <td>
                                        <a href="{{$trainer->restoreUrl()}}">
                                            <button data-toggle="modal" class="btn btn-info text-white">Restaurer</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$trainer->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$trainer->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un formateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.trainer.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$trainer->slug}}">
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
                            <th>Identifiant</th>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Fonction</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div
@endsection
