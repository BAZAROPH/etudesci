@extends('admin.base', [
    'title' => 'Modifier un cabinets',
    'active' => 'offices',
    'subActive' => 'offices-list'
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
            <h4>Modifier {{$office->name}}</h4>
            <a href="{{route('admin.office.index')}}"><button class="btn btn-primary">Liste des cabinet</button></a>
        </div>
    </div>
    <form action="{{route('admin.office.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="slug" value="{{$office->slug}}">
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label d-none">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="{{$office->getFirstMediaUrl('offices')}}" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="last_name" class="required">Nom</label>
                        <input value="{{$office->name}}" type="text" name="name" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="email" class="required">Email</label>
                        <input value="{{$office->email}}" type="email" name="email" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="address" class="required">Adresse</label>
                        <input value="{{$office->address}}" type="text" name="address" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="required">Numéro de téléphone</label>
                        <input value="{{$office->phone}}" type="text" name="phone" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="accreditassion" class="required">Accréditations</label>
                        <select name="accreditassions[]" class="form-control input-default" multiple>
                            @foreach ($accreditassions as $accreditassion)
                                <option value="{{$accreditassion->id}}" @if($office->Accreditassions->Contains('id', $accreditassion->id)) selected='selected' @endif>{{$accreditassion->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}" @if($office->Domaines->Contains('id', $domaine->id)) selected='selected' @endif>{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="website">Site web</label>
                        <input value="{{$office->website}}" type="text" name="website" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="facebook">Lien Facebook</label>
                        <input value="{{$office->facebook}}" type="url" name="facebook" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="twitter">Lien twitter</label>
                        <input value="{{$office->twitter}}" type="url" name="twitter" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="linkedin">Lien Linkedin</label>
                        <input value="{{$office->linkedin}}" type="url" name="linkedin" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="youtube">Lien Youtube</label>
                        <input value="{{$office->youtube}}" type="url" name="youtube" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-12">
                        <label for="description" class="required">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {!! html_entity_decode($office->description) !!}
                        </textarea>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
