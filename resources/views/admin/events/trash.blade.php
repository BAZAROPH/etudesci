@extends('admin.base', [
    'title' => 'Corbeille des évènements',
    'active' => 'events',
    'subActive' => 'events-trash'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Corbeille des events</h4>
                <a href="{{route('admin.event.create')}}">
                    <button class="btn btn-primary">Ajouter un évènement</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Type de lieu</th>
                                <th>Lieu</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Téléphone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr class="text-center">
                                    <td>{{$event->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$event->getFirstMediaUrl('events')}}" alt="">
                                    </td>
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->place_type}}</td>
                                    <td>{{$event->place}}</td>
                                    <td>{{$event->start_date}}</td>
                                    <td>{{$event->end_date}}</td>
                                    <td>{{$event->phone}}</td>
                                    <td>
                                        <a href="{{$event->restoreUrl()}}">
                                            <button data-toggle="modal" class="btn btn-info text-white">Restaurer</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$event->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$event->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.event.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$event->slug}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Cette action est irréversible !
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
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Type de lieu</th>
                                <th>Lieu</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Téléphone</th>
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
