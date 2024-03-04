@extends('admin.base', [
    'title' => 'Cabinets supprimés',
    'active' => 'offices',
    'subActive' => 'offices-trash'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des cabinets supprimés</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>email</th>
                                <th>Téléphone</th>
                                <th>Site web</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                                <tr class="text-center">
                                    <td>{{$office->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$office->getFirstMediaUrl('offices')}}" alt="">
                                    </td>
                                    <td>{{$office->name}}</td>
                                    <td>{{$office->email}}</td>
                                    <td>{{$office->phone}}</td>
                                    <td>{{$office->website}}</td>
                                    <td>
                                        <a href="{{$office->restoreUrl()}}">
                                            <button data-toggle="modal" class="btn btn-info text-white">Restaurer</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$office->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$office->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un cabinet</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.office.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$office->slug}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Cette action est irréversible et supprimera toute entité liée à ce cabinet.
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
                                <th>Image</th>
                                <th>Nom</th>
                                <th>email</th>
                                <th>Téléphone</th>
                                <th>Site web</th>
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
