@extends('admin.base', [
    'title' => 'Créer un article',
    'active' => 'articles',
    'subActive' => 'new-article'
])

@section('content')
    @if($errors->any())
        <div class="badge-danger row mb-4 p-2 rounded text-center">
                @foreach ($errors->all() as $error )
                    <div class="col-12 mx-4"><i class="bi bi-exclamation-triangle-fill pr-2"></i>{{$error}}</div>
                @endforeach
        </div>
    @endif
    <div class="row mb-2">
        <div class="col-12 text-right">
            <a href="{{route('admin.article.index')}}"><button class="btn btn-primary">Liste des articles</button></a>
        </div>
    </div>
    <form action="{{route('admin.article.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer d-none" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="title" class="required">Titre</label>
                        <input value="{{old('title')}}" type="text" name="title" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="subtitle" class="">Sous titre</label>
                        <input value="{{old('subtitle')}}" type="text" name="subtitle" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="author" class="required">Auteur</label>
                        <select value="{{old('author')}}" name="authors[]" class="form-control input-default" multiple>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->last_name}} {{$author->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select  name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}">{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type d'article</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="text" class="required">Contenu</label>
                        <textarea value="{{old('text')}}" id="summernote" class="summernote" name="text"></textarea>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
