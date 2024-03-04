@extends('admin.base', [
    'title' => 'Corbeille des livres',
    'active' => 'books',
    'subActive' => 'books-trash'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Corbeille des livres</h4>
                <a href="{{route('admin.book.create')}}">
                    <button class="btn btn-primary">Ajouter un auteur</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Couverture</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Prix</th>
                                <th>Réduction</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr class="text-center">
                                    <td>{{$book->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$book->getFirstMediaUrl('books')}}" alt="">
                                    </td>
                                    <td>{{$book->title}}</td>
                                    <td>
                                        @foreach ($book->Authors as $author)
                                            {{$author->last_name}}
                                            {{$author->first_name}}
                                        @endforeach
                                    </td>
                                    <td>{{$book->price}}</td>
                                    <td>{{$book->reduction}}</td>
                                    <td>
                                        <a href="{{$book->restoreUrl()}}">
                                            <button data-toggle="modal" class="btn btn-info text-white">Restaurer</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$book->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$book->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'livres</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.book.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$book->slug}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Cette action est irréversible
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
                                <th>Couverture</th>
                                <th>Titre</th>
                                <th>Auteur</th>
                                <th>Prix</th>
                                <th>Réduction</th>
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
