@extends('admin.base', [
    'title' => 'Créer un livre',
    'active' => 'books',
    'subActive' => 'new-book'
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
            <a href="{{route('admin.book.index')}}"><button class="btn btn-primary">Liste des livres</button></a>
        </div>
    </div>
    <form action="{{route('admin.book.store')}}" method="post" enctype="multipart/form-data">
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
                        <input value="{{old('title')}}" type="text" name="title" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="author" class="required">Auteur</label>
                        <select name="authors[]" class="form-control input-default" multiple>
                            @foreach ($authors as $author)
                                <option value="{{$author->id}}">{{$author->last_name}} {{$author->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="price" class="required">Prix</label>
                        <input value="{{old('price')}}" min=0 type="number" name="price" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="reduction" class="">Réduction</label>
                        <input value="{{old('reduction')}}" min=0 max=100 type="number" name="reduction" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="premium_price" class="required">Prix Premium</label>
                        <input value="{{old('premium_price')}}" min=0 type="number" name="premium_price" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="script" class="required">Script</label>
                        <input value="{{old('script')}}" type="text" name="script" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select value="{{old('domaines')}}" name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}">{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="required">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {!! html_entity_decode(old('description')) !!}
                        </textarea>
                    </div>
                </div>
                <div class="my-4 text-center">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
