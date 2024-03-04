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
    <form action="{{route('admin.certification.store')}}" method="post" enctype="multipart/form-data">
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
                        <label for="price" class="required">Prix</label>
                        <input value="{{old('price')}}" min=0 type="number" name="price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="reduction" class="" min=0 max=100>Réduction</label>
                        <input value="{{old('reduction')}}" type="number" name="reduction" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="premium_price">Prix Premium</label>
                        <input value="{{old('premium_price')}}" min=0 type="number" name="premium_price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="office_money">Prix du cabinet</label>
                        <input value="{{old('office_money')}}" min=0 type="number" name="office_money" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="start_date" class="required">Date de début</label>
                        <input value="{{old('start_date')}}" type="datetime-local" name="start_date" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="end_date" class="required">Date de Fin</label>
                        <input value="{{old('end_date')}}" type="datetime-local" name="end_date" class="form-control input-default" >
                    </div>
                    <div class="col-12 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}" @if(!is_null(old('domaines')) && in_array($domaine->id, old('domaines'))) selected='selected' @endif>{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 form-group">
                        <label for="location_type" class="required">Type de lieu </label>
                        <select name="location_type" id="location_type" class="form-control">
                            <option value="online">En ligne</option>
                            <option value="present">En présentiel</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="email" class="required">Email</label>
                        <input value="{{old('email')}}" type="email" name="email" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="website" class="">Site web</label>
                        <input value="{{old('website')}}" type="url" name="website" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="required">Téléphone</label>
                        <input value="{{old('phone')}}" type="text" name="phone" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="whatsapp" class="">Whatsapp</label>
                        <input value="{{old('whatsapp')}}" type="text" name="whatsapp" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="script" class="">Script</label>
                        <input value="{{old('script')}}" type="text" name="script" class="form-control input-default" >
                    </div>
                    <div class="col-6 form-group">
                        <label for="personalized_script" class="">Script Personnalisé</label>
                        <input value="{{old('personalized_script')}}" type="text" name="personalized_script" class="form-control input-default" >
                    </div>
                    <div class="col-12">
                        <label for="description" class="required">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {{old('description')}}
                        </textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="objective" class="">Objectifs</label>
                        <textarea id="summernote" class="summernote" name="objective">
                            {!! html_entity_decode(old('objective')) !!}
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
