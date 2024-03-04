@extends('admin.base', [
    'title' => 'Liste de online Classrooms',
    'active' => 'online-class',
    'subActive' => 'online-class'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des cours</h4>
                <div>
                    <a href="{{route('admin.onlineClass.create')}}">
                        <button class="btn btn-primary">Ajouter une online class</button>
                    </a>
                    <a href="{{route('admin.onlineClass.trash')}}"><button class="btn btn-secondary">Corbeille</button></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Speaker</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($onlineClasses as $onlineClass)
                                <tr>
                                    <td class="text-center"><img class='author-photo' src="{{$onlineClass->getFirstMediaUrl('onlineClass')}}" alt=""></td>
                                    <td class="text-center">{{$onlineClass->title}}</td>
                                    <td class="text-center">{{$onlineClass->date}}</td>
                                    <td class="text-center">{{$onlineClass->hour}}</td>
                                    <td class="text-center">{{$onlineClass->Trainer->first_name}} {{$onlineClass->Trainer->last_name}}</td>
                                    <td class="text-truncate text-center">
                                        <a href="{{$onlineClass->editUrl($onlineClass->slug)}}">
                                            <button data-toggle="modal" class="btn btn-warning text-white">Modifier</button>
                                        </a>
                                        <button data-toggle="modal" data-target="#deleteModal{{$onlineClass->id}}" class="btn btn-danger text-white">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$onlineClass->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer {{$onlineClass->title}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.onlineClass.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$onlineClass->slug}}">
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
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Speaker</th>
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
