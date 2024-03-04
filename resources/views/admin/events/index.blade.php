@extends('admin.base', [
    'title' => 'Liste des évènements',
    'active' => 'events',
    'subActive' => 'events-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des évènements</h4>
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
                                <th>Lieu</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
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
                                    <td>{{$event->place}}</td>
                                    <td>{{$event->start_date}}</td>
                                    <td>{{$event->end_date}}</td>
                                    <td class="text-truncate">
                                        @if (!$event->published)
                                            <a href="{{$event->publishedUrl()}}">
                                                <button data-toggle="modal" class="btn btn-primary text-white">Publier</button>
                                            </a>
                                        @else
                                            <a href="{{$event->publishedUrl()}}">
                                                <button data-toggle="modal" class="btn btn-warning text-white">Dépublier</button>
                                            </a>
                                        @endif
                                        <a href="{{$event->editUrl()}}">
                                            <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
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
                                                    <form action="{{route('admin.event.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$event->slug}}">
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
                                <th>Photo</th>
                                <th>Nom</th>
                                <th>Lieu</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
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
