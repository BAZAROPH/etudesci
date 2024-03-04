@extends('admin.base', [
    'title' => 'Créer une online class',
    'active' => 'online-class',
    'subActive' => 'online-class',
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
            <a href="{{route('admin.onlineClass.index')}}"><button class="btn btn-primary">Liste des online classrooms</button></a>
            <a href="{{route('admin.onlineClass.trash')}}"><button class="btn btn-secondary">Corbeille</button></a>
        </div>
    </div>
    <form action="{{route('admin.onlineClass.store')}}" method="post" enctype="multipart/form-data">
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
                        <label for="trainer" class="required">Formateur</label>
                        <select value="{{old('trainer')}}" name="trainer" class="form-control input-default">
                            @foreach ($trainers as $trainer)
                                <option value="{{$trainer->id}}">{{$trainer->last_name}} {{$trainer->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="date" class="required">Date</label>
                        <input value="{{old('date')}}" type="date" name="date" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="hour" class="required">Heure</label>
                        <input value="{{old('hour')}}" type="time" name="hour" class="form-control input-default" >
                    </div>
                    <div class="col-12 form-group">
                        <label for="script" class="required">Script</label>
                        <input value="{{old('script')}}" type="text" name="script" class="form-control input-default" >
                    </div>
                    <div class="col-12 form-group">
                        <label for="type" class="required">Type</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            <option value="onlineclass" selected>Onlineclass</option>
                            <option value="webinaire">Webinaire</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="required">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {{old('description')}}
                        </textarea>
                    </div>
                    <div class="col-12 mt-4">
                        <label for="description" class="required">Fichier Tokens</label><br>
                        <input type="file" accept=".csv" name="tokens">
                    </div>
                    <div class="col-12 mt-4">
                        <label for="code" class="">Code de l'email</label><br>
                        <textarea type="text" name="code" class="form form-control"> </textarea>
                    </div>
                </div>
                <div class="my-4 text-center">
                    <button class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
@endsection
