@extends('admin.base', [
    'title' => 'Modifier un cours',
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
    <form action="{{route('admin.course.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="slug" value="{{$course->slug}}">
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label d-none">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="{{$course->getFirstMediaUrl('courses')}}" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="title" class="required">Titre</label>
                        <input value="{{$course->title}}" type="text" name="title" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="office" class="required">Cabinet</label>
                        <select value="{{$course->office}}" name="office" class="form-control input-default">
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}" @if($office->id == $course->Office->id) selected='selected' @endif>{{$office->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="trainer" class="required">Formateur</label>
                        <select value="{{$course->trainer}}" name="trainer" class="form-control input-default">
                            @foreach ($trainers as $trainer)
                                <option value="{{$trainer->id}}" @if($trainer->id == $course->Trainer->id) selected='selected' @endif>{{$trainer->last_name}} {{$trainer->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="youtube" class="required">Lien youtube</label>
                        <input value="{{$course->youtube}}" type="url" name="youtube" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            <option value="onlineclass" @if ($course->type == 'onlineclass') selected @endif>Online Classroom</option>
                            <option value="course" @if ($course->type == 'course') selected @endif>Cours</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select value="{{old('domaines')}}" name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}" @if($course->Domaines->Contains('id', $domaine->id)) selected='selected' @endif>{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {!! html_entity_decode($course->description) !!}
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
