@extends('admin.base', [
    'title' => 'Liste des articles',
    'active' => 'articles',
    'subActive' => 'articles-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des articles</h4>
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
                                    <td class="text-truncate">{{$article->title}}</td>
                                    <td class="text-truncate">{{$article->Type->label}}</td>
                                    <td class="text-truncate">
                                        @foreach ($article->Authors as $author)
                                            {{$author->last_name}}
                                            {{$author->first_name}}
                                        @endforeach
                                    </td>
                                    <td class="text-truncate">
                                        @if (!$article->published)
                                            <a href="{{$article->publishedUrl()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-primary text-white">Publier</button>
                                            </a>
                                        @else
                                            <a href="{{$article->publishedUrl()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-warning text-white">Dépublier</button>
                                            </a>
                                        @endif
                                        <a href="{{$article->editUrl()}}">
                                            <button data-toggle="modal" class="mr-1 btn btn-success text-white">Modifier</button>
                                        </a>
                                        <button class="mr-1 btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$article->id}}">Supprimer</button>

                                        @if (!$article->vertical_slide)
                                            <a href="{{$article->leftSlide()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-primary text-white">Slider Gauche</button>
                                            </a>
                                        @else
                                            <a href="{{$article->leftSlide()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-warning text-white">Déslider Gauche</button>
                                            </a>
                                        @endif

                                        @if (!$article->horizontal_slide)
                                            <a href="{{$article->rightSlide()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-primary text-white">Slider Droite</button>
                                            </a>
                                        @else
                                            <a href="{{$article->rightSlide()}}">
                                                <button data-toggle="modal" class="mr-1 btn btn-warning text-white">Déslider Droite</button>
                                            </a>
                                        @endif
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$article->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'articles</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.article.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$article->slug}}">
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
                                <th>Titre</th>
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
