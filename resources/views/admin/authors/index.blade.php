@extends('admin.base', [
    'title' => 'Liste des auteurs',
    'active' => 'authors',
    'subActive' => 'authors-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des auteurs</h4>
                <a href="{{route('admin.author.create')}}">
                    <button class="btn btn-primary">Ajouter un auteur</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Entreprise</th>
                                <th>Poste occupé</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                                <tr class="text-center">
                                    <td>{{$author->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$author->getFirstMediaUrl('authors')}}" alt="">
                                    </td>
                                    <td>{{$author->first_name}}</td>
                                    <td>{{$author->last_name}}</td>
                                    <td>{{$author->company}}</td>
                                    <td>{{$author->function}}</td>
                                    <td>{{$author->Type->label}}</td>
                                    <td>
                                        <a href="{{$author->editUrl()}}">
                                            <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$author->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$author->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.author.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$author->slug}}">
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
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Entreprise</th>
                                <th>Poste occupé</th>
                                <th>Type</th>
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
