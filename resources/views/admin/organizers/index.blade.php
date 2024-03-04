@extends('admin.base', [
    'title' => 'Liste des formateurs',
    'active' => 'organizers',
    'subActive' => 'organizers-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des formateurs</h4>
                <a href="{{route('admin.organizer.create')}}">
                    <button class="btn btn-primary">Ajouter un cabinet</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Image</th>
                                <th>Nom</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($organizers as $organizer)
                                <tr class="text-center">
                                    <td>{{$organizer->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$organizer->getFirstMediaUrl('organizers')}}" alt="">
                                    </td>
                                    <td>{{$organizer->name}}</td>
                                    <td>{{$organizer->contact}}</td>
                                    <td>
                                        <a href="{{$organizer->editUrl()}}">
                                            <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$organizer->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$organizer->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un formateur</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.organizer.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$organizer->slug}}">
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
                            <th>Contact</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
