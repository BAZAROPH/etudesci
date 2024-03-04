@extends('admin.base', [
    'title' => 'Liste des cours',
    'active' => 'courses',
    'subActive' => 'courses-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des cours</h4>
                <a href="{{route('admin.course.create')}}">
                    <button class="btn btn-primary">Ajouter un cours</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Cabinet</th>
                                <th>Formateur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="text-center">
                                    <td>{{$course->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$course->getFirstMediaUrl('courses')}}" alt="">
                                    </td>
                                    <td>{{$course->title}}</td>
                                    <td>{{$course->Office->name}}</td>
                                    <td>{{$course->Trainer->last_name}} {{$course->Trainer->first_name}}</td>
                                    <td class="text-truncate">
                                        @if (!$course->published)
                                            <a href="{{$course->publishedUrl()}}">
                                                <button data-toggle="modal" class="btn btn-primary text-white">Publier</button>
                                            </a>
                                        @else
                                            <a href="{{$course->publishedUrl()}}">
                                                <button data-toggle="modal" class="btn btn-warning text-white">Dépublier</button>
                                            </a>
                                        @endif
                                        <a href="{{$course->moduleUrl()}}">
                                            <button data-toggle="modal" class="btn btn-secondary text-white">Modules</button>
                                        </a>
                                        @if ($course->type == 'onlineclass')
                                            <a href="{{route('admin.onlineClass.quiz.index', [$course->slug])}}">
                                                <button class="btn btn-primary text-white">Test</button>
                                            </a>
                                        @endif
                                        <a href="{{$course->editUrl()}}">
                                            <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$course->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$course->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.course.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$course->slug}}">
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
                                <th>Image</th>
                                <th>Titre</th>
                                <th>Cabinet</th>
                                <th>Formateur</th>
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
