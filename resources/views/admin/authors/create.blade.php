@extends('admin.base', [
    'title' => 'Créer un auteur',
    'active' => 'authors',
    'subActive' => 'new-author'
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
            <a href="{{route('admin.author.index')}}"><button class="btn btn-primary">Liste des auteurs</button></a>
        </div>
    </div>
    <form action="{{route('admin.author.store')}}" method="post" enctype="multipart/form-data">
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
                        <label for="last_name" class="required">Nom</label>
                        <input value="{{old('last_name')}}" type="text" name="last_name" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="first_name" class="required">Prénom</label>
                        <input value="{{old('first_name')}}" type="text" name="first_name" class="form-control input-default ">
                    </div>
                    <div class="col-6 form-group">
                        <label for="company">Entreprise</label>
                        <input value="{{old('company')}}" type="text" name="company" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="function">Fonction (Poste occupé)</label>
                        <input value="{{old('function')}}" type="text" name="function" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type d'auteur</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->label}}</option>
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
