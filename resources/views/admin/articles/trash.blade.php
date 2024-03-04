@extends('admin.base', [
    'title' => 'Corebeille des articles',
    'active' => 'articles',
    'subActive' => 'articles-trash'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Corbeille des articles</h4>
                <a href="{{route('admin.article.create')}}">
                    <button class="btn btn-primary">Ajouter un article</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Titre</th>
                                <th>Sous titre</th>
                                <th>Type</th>
                                <th>Auteur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr class="text-center">
                                    <td>{{$article->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$article->getFirstMediaUrl('articles')}}" alt="">
                                    </td>
                                    <td>{{$article->title}}</td>
                                    <td>{{$article->subtitle}}</td>
                                    <td>{{$article->Type->label}}</td>
                                    <td>
                                        @foreach ($article->Authors as $author)
                                            {{$author->last_name}}
                                            {{$author->first_name}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{$article->restoreUrl()}}">
                                            <button data-toggle="modal" class="btn btn-info text-white">Restaurer</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$article->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$article->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'articles</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.article.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$article->slug}}">
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
                                <th>Titre</th>
                                <th>Sous titre</th>
                                <th>Type</th>
                                <th>Auteur</th>
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
