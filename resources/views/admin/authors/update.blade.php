@extends('admin.base', [
    'title' => 'Créer un auteur',
    'active' => 'authors',
    'subActive' => 'authors-list'
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
            <div class="col-12 d-flex justify-content-between">
                <h4 class="text-primary">Modifier {{$author->last_name}} {{$author->first_name}}</h4>
                <a href="{{route('admin.author.index')}}"><button class="btn btn-primary">Liste des auteurs</button></a>
            </div>
        </div>
        <form action="{{route('admin.author.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="slug" value={{$author->slug}}>
            <div class="row">
                <div class="col-4 text-center">
                    <div id="file-block">
                        <label id="upload-label" class="upload-label d-none">
                            <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                            <i class="icofont-cloud-upload text-primary upload-icon"></i>
                        </label>
                        <div class="text-center">
                            <img id="image-preview" class="preview-image" src="{{$author->getFirstMediaUrl('authors')}}" alt=""> <br>
                            <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                        </div>
                    </div>
                </div>
                <div class="col-8 text-primary">
                    <div class="row border-group">
                        <div class="col-6 form-group">
                            <label for="last_name" class="required">Nom</label>
                            <input type="text" name="last_name" class="form-control input-default" value="{{$author->last_name}}" placeholder="nom de l'auteur">
                        </div>
                        <div class="col-6 form-group">
                            <label for="first_name" class="required">Prénom</label>
                            <input type="text" name="first_name" class="form-control input-default" value="{{$author->first_name}}" placeholder="prénom de l'auteur">
                        </div>
                        <div class="col-6 form-group">
                            <label for="company">Entreprise</label>
                            <input type="text" name="company" class="form-control input-default" value="{{$author->company}}" placeholder="">
                        </div>
                        <div class="col-6 form-group">
                            <label for="function">Fonction (Poste occupé)</label>
                            <input type="text" name="function" class="form-control input-default" value="{{$author->function}}" placeholder="">
                        </div>
                        <div class="col-6 form-group">
                            <label for="function" class="required">Type d'auteur</label>
                            <select name="type" class="form-control input-default">
                                @foreach ($types as $type)
                                    <option value="{{$type->id}}" @if($type->id == $author->Type->id) selected='selected' @endif>{{$type->label}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <button class="btn btn-primary">Enregistrer</button>
                    </div>
                </div>
            </div>
        </form>
@endsection
