@extends('admin.base', [
    'title' => 'Créer un cabinet',
    'active' => 'offices',
    'subActive' => 'new-office',
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
        <a href="{{route('admin.author.index')}}"><button class="btn btn-primary">Liste des cabinet</button></a>
    </div>
</div>
<form action="{{route('admin.office.store')}}" method="post" enctype="multipart/form-data">
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
                    <label for="name" class="required">Nom</label>
                    <input value="{{old('name')}}" type="text" name="name" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="email" class="required">Email</label>
                    <input value="{{old('email')}}" type="email" name="email" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="address" class="required">Adresse</label>
                    <input value="{{old('address')}}" type="text" name="address" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="phone" class="required">Numéro de téléphone</label>
                    <input value="{{old('phone')}}" type="text" name="phone" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="accreditassion" class="required">Accréditassion</label>
                    <select name="accreditassions[]" class="form-control input-default" multiple>
                        @foreach ($accreditassions as $accreditassion)
                            <option value="{{$accreditassion->id}}">{{$accreditassion->label}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="domaine" class="required">Domaine</label>
                    <select value="{{old('domaines')}}" name="domaines[]" class="form-control input-default" multiple>
                        @foreach ($domaines as $domaine)
                            <option value="{{$domaine->id}}">{{$domaine->label}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="website">Site web</label>
                    <input value="{{old('website')}}" type="text" name="website" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="facebook">Lien Facebook</label>
                    <input value="{{old('facebook')}}" type="url" name="facebook" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="twitter">Lien twitter</label>
                    <input value="{{old('twitter')}}" type="url" name="twitter" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="linkedin">Lien Linkedin</label>
                    <input value="{{old('linkedin')}}" type="url" name="linkedin" class="form-control input-default " placeholder="">
                </div>
                <div class="col-6 form-group">
                    <label for="youtube">Lien Youtube</label>
                    <input value="{{old('youtube')}}" type="url" name="youtube" class="form-control input-default " placeholder="">
                </div>
                <div class="col-12">
                    <label for="description" class="required">Description</label>
                    <textarea value="{{old('description')}}" id="summernote" class="summernote" name="description"></textarea>
                </div>
            </div>
            <div class="mt-4 text-center">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
@endsection
