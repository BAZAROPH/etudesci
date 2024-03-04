@extends('admin.base', [
    'title' => 'Créer un évènement',
    'active' => 'events',
    'subActive' => 'new-event'
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
            <a href="{{route('admin.event.index')}}"><button class="btn btn-primary">Liste des évènements</button></a>
        </div>
    </div>
    <form action="{{route('admin.event.store')}}" method="post" enctype="multipart/form-data">
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
                        <input value="{{old('name')}}" type="text" name="name" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="organizer" class="required">Organisateur</label>
                        <select value="{{old('organizer')}}" name="organizer" class="form-control input-default">
                            @foreach ($organizers as $organizer)
                                <option value="{{$organizer->id}}">{{$organizer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type</label>
                        <select value="{{old('type')}}" name="type" class="form-control input-default">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}">{{$type->label}}</option>
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
                        <label for="price">Prix</label>
                        <input value="{{old('price')}}" min=0 type="number" name="price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="reduction">Réduction</label>
                        <input value="{{old('reduction')}}" min=0 max=100 type="number" name="reduction" class="form-control input-default " >
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
                        <label for="email">Email</label>
                        <input value="{{old('email')}}" min=0 type="email" name="email" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="start_date" class="required">Date de début</label>
                        <input value="{{old('start_date')}}" min=0 type="datetime-local" name="start_date" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="end_date" class="required">Date de fin</label>
                        <input value="{{old('end_date')}}" min=0 type="datetime-local" name="end_date" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="place_type" class="required">Type de lieu</label>
                        <select value="{{old('place_type')}}" name="place_type" class="form-control input-default">
                            <option value="present">Présentiel</option>
                            <option value="online">En ligne</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="place" class="required">Lieu ou Support de suivi</label>
                        <input value="{{old('place')}}" type="text" name="place" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="personalized_link">Lien personnalisé</label>
                        <input value="{{old('personalized_link')}}" type="text" name="personalized_link" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="registration_link">Lien d'inscription</label>
                        <input value="{{old('registration_link')}}" type="text" name="registration_link" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="required">Téléphone</label>
                        <input value="{{old('phone')}}" type="text" name="phone" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="facebook">Facebook</label>
                        <input value="{{old('facebook')}}" type="text" name="facebook" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="twitter">Twitter</label>
                        <input value="{{old('twitter')}}" type="text" name="twitter" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="linkedin">Linkedin</label>
                        <input value="{{old('linkedin')}}" type="text" name="linkedin" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="youtube">Youtube</label>
                        <input value="{{old('youtube')}}" type="text" name="youtube" class="form-control input-default " >
                    </div>
                    <div class="col-12">
                        <label for="description">Description</label>
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
