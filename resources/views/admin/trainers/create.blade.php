@extends('admin.base', [
    'title' => 'Créer un formateur',
    'active' => 'tainers',
    'subActive' => 'new-trainer'
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
            <a href="{{route('admin.author.index')}}"><button class="btn btn-primary">Liste des formateurs</button></a>
        </div>
    </div>
    <form action="{{route('admin.trainer.store')}}" method="post" enctype="multipart/form-data">
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
                        <input value="{{old('last_name')}}" type="text" name="last_name" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="first_name" class="required">Prénom</label>
                        <input value="{{old('first_name')}}" type="text" name="first_name" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="address" class="">Adresse</label>
                        <input value="{{old('address')}}" type="text" name="address" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="campany">Entreprise</label>
                        <input value="{{old('campany')}}" type="text" name="campany" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="email" class="required">Email</label>
                        <input value="{{old('email')}}" type="email" name="email" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="contact" class="required">Contact</label>
                        <input value="{{old('contact')}}" type="text" name="contact" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="function">Fonction</label>
                        <input value="{{old('function')}}" type="text" name="function" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="facebook">Facebook</label>
                        <input value="{{old('facebook')}}" type="url" name="facebook" class="form-control input-default " placeholder="">
                    </div>
                    <div class="col-6 form-group">
                        <label for="twitter">Twitter</label>
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
                        <label for="description" class="">Description</label>
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
