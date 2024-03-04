@extends('admin.base', [
    'title' => 'Modifier une accréditation',
    'active' => 'accreditassions',
    'subActive' => 'accreditassions-list'
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
            <a href="{{route('admin.accreditassion.index')}}"><button class="btn btn-primary">Liste des accréditations</button></a>
        </div>
    </div>
    <form action="{{route('admin.accreditassion.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$accreditassion->id}}">
        <div class="row">
            <div class="col-4 text-center">
                <div id="file-block">
                    <label id="upload-label" class="upload-label d-none">
                        <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                        <i class="icofont-cloud-upload text-primary upload-icon"></i>
                    </label>
                    <div class="text-center">
                        <img id="image-preview" class="preview-image" src="{{$accreditassion->getFirstMediaUrl('accreditassions')}}" alt=""> <br>
                        <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                    </div>
                </div>
            </div>
            <div class="col-8 text-primary">
                <div class="row border-group">
                    <div class="col-6 form-group">
                        <label for="acronym" class="required">Acronyme</label>
                        <input value="{{$accreditassion->acronym}}" type="text" name="acronym" class="form-control input-default " >
                    </div>
                    <div class="col-6 form-group">
                        <label for="label" class="required">Libellé</label>
                        <input value="{{$accreditassion->label}}" type="text" name="label" class="form-control input-default " >
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4 text-center">
            <button class="btn btn-primary">Enregistrer</button>
        </div>
    </form>
@endsection
