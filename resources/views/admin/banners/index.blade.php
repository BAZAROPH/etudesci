@extends('admin.base', [
    'title' => 'Bannières',
    'active' => 'banners',
    'subActive' => 'banners'
])

@section('content')
@if($errors->any())
    <div class="badge-danger row mb-4 p-2 rounded text-center">
        @foreach ($errors->all() as $error )
            <div class="col-12 mx-4"><i class="bi bi-exclamation-triangle-fill pr-2"></i>{{$error}}</div>
        @endforeach
    </div>
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des types d'évènement</h4>
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter une nouvelle bannière</button>
                <!-- ADD Modal -->
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer une nouvelle bannière</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.banners.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <div id="file-block">
                                                <label id="upload-label" class="upload-label">
                                                    <input name="media" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                                                    <i class="icofont-cloud-upload text-primary upload-icon"></i>
                                                </label>
                                                <div class="text-center">
                                                    <img id="image-preview" class="preview-image" src="" alt=""> <br>
                                                    <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer d-none" onclick="dropImage()"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-left">
                                            <label for="" class="text-primary ">Lien</label>
                                            <input class="form-control form-control-lg" type="url" name="link" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Lien</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medias as $banner)
                                <tr class="text-center">
                                    <td>{{$banner->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$banner->getFirstMediaUrl('banners')}}" alt="">
                                    </td>
                                    <td>{{$banner->link}}</td>
                                    <td>{{$banner->reduction}}</td>
                                    <td>{{$banner->created_at}}</td>
                                    <td>
                                        <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$banner->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$banner->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$banner->slug}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Lien</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

