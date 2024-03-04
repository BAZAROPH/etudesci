@extends('admin.base', [
    'title' => 'Créer un cours',
    'active' => 'cours',
    'subActive' => 'new-course'
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
            <a href="{{route('admin.course.index')}}"><button class="btn btn-primary">Liste des cours</button></a>
        </div>
    </div>
    <form action="{{route('admin.course.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block ">
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
                        <label for="office" class="required">Cabinet</label>
                        <select value="{{old('office')}}" name="office" class="form-control input-default">
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}">{{$office->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="trainer" class="required">Formateur</label>
                        <select value="{{old('trainer')}}" name="trainer" class="form-control input-default">
                            @foreach ($trainers as $trainer)
                                <option value="{{$trainer->id}}">{{$trainer->last_name}} {{$trainer->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="youtube" class="required">Lien youtube</label>
                        <input value="{{old('youtube')}}" type="url" name="youtube" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            <option value="onlineclass">Online Classroom</option>
                            <option value="course">Cours</option>
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
                    <div class="col-12">
                        <label for="description" class="">Description</label>
                        <textarea value="{{old('description')}}" id="summernote" class="summernote" name="description"></textarea>
                    </div>
                </div>
                <div class="my-4 text-center">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
