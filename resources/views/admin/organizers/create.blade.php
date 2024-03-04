@extends('admin.base', [
    'title' => 'Créer un formateur',
    'active' => 'organizers',
    'subActive' => 'new-oragnizer'
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
            <a href="{{route('admin.organizer.index')}}"><button class="btn btn-primary">Liste des formateurs</button></a>
        </div>
    </div>
    <form action="{{route('admin.organizer.store')}}" method="post" enctype="multipart/form-data">
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
                        <label for="contact" class="required">Contact</label>
                        <input value="{{old('contact')}}" type="text" name="contact" class="form-control input-default " placeholder="">
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
