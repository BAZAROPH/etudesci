@extends('admin.base', [
    'title' => 'Créer une certification',
    'active' => 'certifications',
    'subActive' => 'new-certification'
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
            <a href="{{route('admin.certification.index')}}"><button class="btn btn-primary">Liste des certifications</button></a>
        </div>
    </div>
    <form action="{{route('admin.certification.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="slug" value="{{$certification->slug}}">
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label d-none">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="{{$certification->getFirstMediaUrl('certifications')}}" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="title" class="required">Titre</label>
                        <input value="{{$certification->title}}" type="text" name="title" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="office" class="required">Cabinet</label>
                        <select value="{{old('office')}}" name="office" class="form-control input-default">
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}" @if ($office->id == $certification->Office->id) selected='selected' @endif>{{$office->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="price" class="required">Prix</label>
                        <input value="{{$certification->price}}" min=0 type="number" name="price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="reduction" class="" min="0" max=100>Réduction</label>
                        <input value="{{$certification->reduction}}" type="number" name="reduction" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="premium_price">Prix Premium</label>
                        <input value="{{$certification->premium_price}}" min=0 type="number" name="premium_price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="office_money">Prix du cabinet</label>
                        <input value="{{$certification->office_money}}" min=0 type="number" name="office_money" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="start_date" class="required">Date de début</label>
                        <input value="{{$certification->start_date}}" type="datetime-local" name="start_date" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="end_date" class="required">Date de Fin</label>
                        <input value="{{$certification->end_date}}" type="datetime-local" name="end_date" class="form-control input-default" >
                    </div>
                    <div class="col-12 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select value="{{old('domaines')}}" name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}" @if($certification->Domaines->Contains('id', $domaine->id)) selected='selected' @endif>{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label for="location_type" class="required">Type de lieu </label>
                        <select name="location_type" id="location_type" class="form-control">
                            <option value="online" @if($certification->location_type == 'online') selected='selected' @endif>En ligne</option>
                            <option value="present" @if($certification->location_type == 'present') selected='selected' @endif>En présentiel</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="email" class="required">Email</label>
                        <input value="{{$certification->email}}" type="email" name="email" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="website" class="">Site web</label>
                        <input value="{{$certification->website}}" type="url" name="website" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="required">Téléphone</label>
                        <input value="{{$certification->phone}}" type="text" name="phone" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="whatsapp" class="">Whatsapp</label>
                        <input value="{{$certification->whatsapp}}" type="text" name="whatsapp" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="script" class="">Script</label>
                        <input value="{{$certification->script}}" type="text" name="script" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="personalized_script" class="">Script Personnalisé</label>
                        <input value="{{$certification->personalized_script}}" type="text" name="personalized_script" class="form-control input-default" >
                    </div>
                    <div class="col-12">
                        <label for="description" class="required">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {!! html_entity_decode($certification->description) !!}
                        </textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="objective" class="">Objectifs</label>
                        <textarea id="summernote" class="summernote" name="objective">
                            {!! html_entity_decode($certification->objective) !!}
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
