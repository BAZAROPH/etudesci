@extends('admin.base', [
    'title' => 'Modifier un évènement',
    'active' => 'events',
    'subActive' => 'events-list'
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
    <form action="{{route('admin.event.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="slug" value="{{$event->slug}}">
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label d-none">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="{{$event->getFirstMediaUrl('events')}}" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="name" class="required">Nom</label>
                        <input value="{{$event->name}}" type="text" name="name" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="organizer" class="required">Organisateur</label>
                        <select value="{{$event->organizer}}" name="organizer" class="form-control input-default">
                            @foreach ($organizers as $organizer)
                                <option value="{{$organizer->id}}">{{$organizer->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="type" class="required">Type</label>
                        <select value="{{$event->type}}" name="type" class="form-control input-default">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}" @selected($event->Type->id == $type->id)>{{$type->label}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="domaine" class="required">Domaine</label>
                        <select value="{{old('domaines')}}" name="domaines[]" class="form-control input-default" multiple>
                            @foreach ($domaines as $domaine)
                                <option value="{{$domaine->id}}" @if($event->Domaines->Contains('id', $domaine->id)) selected='selected' @endif>{{$domaine->label}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="price">Prix</label>
                        <input value="{{$event->price}}" min=0 type="number" name="price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="reduction">Réduction</label>
                        <input value="{{$event->reduction}}" min=0 max=100 type="number" name="reduction" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="premium_price">Prix Premium</label>
                        <input value="{{$event->premium_price}}" min=0 type="number" name="premium_price" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="office_money">Prix du cabinet</label>
                        <input value="{{$event->office_money}}" min=0 type="number" name="office_money" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="email">Email</label>
                        <input value="{{$event->email}}" min=0 type="email" name="email" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="start_date" class="required">Date de début</label>
                        <input value="{{$event->start_date}}" min=0 type="datetime-local" name="start_date" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="end_date" class="required">Date de fin</label>
                        <input value="{{$event->end_date}}" min=0 type="datetime-local" name="end_date" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="place_type" class="required">Type de lieu</label>
                        <select value="{{$event->place_type}}" name="place_type" class="form-control input-default">
                            <option value="present">Présentiel</option>
                            <option value="online">En ligne</option>
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="place" class="required">Lieu ou Support de suivi</label>
                        <input value="{{$event->place}}" type="text" name="place" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="personalized_link">Lien personnalisé</label>
                        <input value="{{$event->personalized_link}}" type="text" name="personalized_link" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="registration_link">Lien d'inscription</label>
                        <input value="{{$event->registration_link}}" type="text" name="registration_link" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="phone" class="required">Téléphone</label>
                        <input value="{{$event->phone}}" type="text" name="phone" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="facebook">Facebook</label>
                        <input value="{{$event->facebook}}" type="text" name="facebook" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="twitter">Twitter</label>
                        <input value="{{$event->twitter}}" type="text" name="twitter" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="linkedin">Linkedin</label>
                        <input value="{{$event->linkedin}}" type="text" name="linkedin" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="youtube">Youtube</label>
                        <input value="{{$event->youtube}}" type="text" name="youtube" class="form-control input-default " >
                    </div>
                    <div class="col-12">
                        <label for="description">Description</label>
                        <textarea id="summernote" class="summernote" name="description">
                            {!! html_entity_decode($event->description) !!}
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
