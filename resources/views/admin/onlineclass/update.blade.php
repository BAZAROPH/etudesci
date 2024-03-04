@extends('admin.base', [
    'title' => 'Liste de online Classrooms',
    'active' => 'online-class',
    'subActive' => 'online-class'
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
    <div class="col-6 text-left text-center">
        <h4>Modifier de la online Class {{$onlineClass->title}}</h4>
    </div>
    <div class="col-6 text-right">
        <a href="{{route('admin.onlineClass.index')}}"><button class="btn btn-primary">Liste des online classrooms</button></a>
    </div>
    </div>
    <form action="{{route('admin.onlineClass.update')}}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="slug" value="{{$onlineClass->slug}}">
        <div class="row">
        <div class="col-4 text-center">
            <div id="file-block">
                <label id="upload-label" class="upload-label d-none">
                    <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                    <i class="icofont-cloud-upload text-primary upload-icon"></i>
                </label>
                <div class="text-center">
                    <img id="image-preview" class="preview-image" src="{{$onlineClass->getFirstMediaUrl('onlineClass')}}" alt=""> <br>
                    <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                </div>
            </div>
        </div>
        <div class="col-8 text-primary">
            <div class="row border-group">
                <div class="col-6 form-group">
                    <label for="title" class="required">Titre</label>
                    <input value="{{$onlineClass->title}}" type="text" name="title" class="form-control input-default " >
                </div>
                <div class="col-6 form-group">
                    <label for="trainer" class="required">Formateur</label>
                    <select value="{{$onlineClass->trainer}}" name="trainer" class="form-control input-default">
                        @foreach ($trainers as $trainer)
                            <option value="{{$trainer->id}}" @if ($trainer->id == $onlineClass->Trainer->id) selected='selected' @endif>{{$trainer->last_name}} {{$trainer->first_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 form-group">
                    <label for="date" class="required">Date</label>
                    <input value="{{$onlineClass->date}}" type="date" name="date" class="form-control input-default" >
                </div>
                <div class="col-6 form-group">
                    <label for="hour" class="required">Heure</label>
                    <input value="{{$onlineClass->hour}}" type="time" name="hour" class="form-control input-default" >
                </div>
                <div class="col-12 form-group">
                    <label for="script" class="required">Script</label>
                    <input value="{{$onlineClass->script}}" type="text" name="script" class="form-control input-default" >
                </div>
                <div class="col-12 form-group">
                    <label for="type" class="required">Type</label>
                    <select name="type" class="form-control input-default">
                        <option value="onlineclass" @if($onlineClass->type == 'onlineclass') selected @endif>Onlineclass</option>
                        <option value="webinaire" @if($onlineClass->type == 'webinaire') selected @endif>Webinaire</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="description" class="required">Description</label>
                    <textarea id="summernote" class="summernote" name="description">
                        {{$onlineClass->description}}
                    </textarea>
                </div>
                <div class="col-12 mt-4">
                    <label for="description" class="required">Fichier Tokens</label><br>
                    <input type="file" accept=".csv" name="tokens">
                </div>
                <div class="col-12 mt-4">
                    <label for="code" class="">Code de l'email</label><br>
                    <textarea type="text" name="code" class="form form-control"> {{$onlineClass->code}} </textarea>
                </div>
            </div>
            <div class="my-4 text-center">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</form>
@endsection
