@extends('admin.base', [
    'title' => 'Modules de cours',
    'active' => 'courses',
    'subActive' => 'courses-list'
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
                <h4 class="card-title text-truncate w-75">Liste des modules du cours " {{$course->title}} "</h4>
                <div class="">
                    <a href="{{route('admin.course.index')}}">
                        <button class="btn btn-success text-white">Liste des cours</button>
                    </a>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Ajouter un module</button>
                </div>
                <!-- ADD Modal -->
                <div class="modal fade" id="addModal">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Créer un nouveau module</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="container">
                                <form action="{{route('admin.module.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_slug" value="{{$course_slug}}">
                                    <div class="row ">
                                        <div class="col-3 text-center">
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
                                        <div class="col-8 text-primary mx-auto">
                                            <div class="row border-group">
                                                <div class="col-6 form-group">
                                                    <label for="title" class="required">Titre</label>
                                                    <input value="{{old('title')}}" type="text" name="title" class="form-control input-default " >
                                                </div>
                                                <div class="col-6 form-group">
                                                    <label for="youtube" class="required">Lien youtube</label>
                                                    <input value="{{old('youtube')}}" type="url" name="youtube" class="form-control input-default " >
                                                </div>
                                                <div class="col-6 form-group">
                                                    <label for="duration" class="required">Durée</label>
                                                    <input value="{{old('duration')}}" type="number" min=0 name="duration" class="form-control input-default " >
                                                </div>
                                                <div class="col-12">
                                                    <label for="description" class="">Description</label>
                                                    <textarea value="{{old('description')}}" id="summernote" class="summernote" name="description"></textarea>
                                                </div>

                                                <div class="col-12 mt-4 ">
                                                    <label for="description" class="">Document</label>
                                                    <div id="file-block" class="text-center">
                                                        <label id="upload-doc-label" class="upload-doc-label">
                                                            <input name="documents[]" class="file-input" id='docs-input' onchange="handleDocs(event)" type="file" multiple>
                                                            <i class="icofont-files-stack text-gray upload-icon"></i>
                                                        </label>
                                                        <div id="doc-preview-block" class="p-3 row doc-preview-block d-none">
                                                            <div class="col-4 d-none" id='file-preview'>
                                                                <div>
                                                                    <i class="icofont-file-alt doc-preview-icon"></i> <br>
                                                                    <span>File Name</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-1 d-none" id='delete-block'>
                                                            <i class="icofont-ui-delete delete-image cursor-pointer" onclick="dropDocs()"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="my-4 text-center">
                                                <button class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                                <th>Titre</th>
                                <th>Cours</th>
                                <th>Durée</th>
                                <th>Nombre de document</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr class="text-center">
                                    <td>{{$module->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$module->getFirstMediaUrl('modules')}}" alt="">
                                    </td>
                                    <td>{{$module->title}}</td>
                                    <td>{{$module->Course->title}}</td>
                                    <td>{{$module->duration}}s</td>
                                    <td>{{count($module->getMedia('documents'))}}</td>
                                    <td class="text-truncate">
                                        <button data-toggle="modal" data-target="#updateModal{{$module->id}}" class="btn btn-success text-white">Modifier</button>
                                        <!-- UPDATE Modal -->
                                        <div class="modal fade" id="updateModal{{$module->id}}">
                                            <div class="modal-dialog  modal-xl" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Créer un nouveau module d'évènement</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="container">
                                                        <form action="{{route('admin.module.update')}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="course_slug" value="{{$course_slug}}">
                                                            <input type="hidden" name="id" value="{{$module->id}}">
                                                            <div class="row ">
                                                                <div class="col-3 text-center">
                                                                    <div id="file-block">
                                                                        <label id="upload-label" class="upload-label d-none">
                                                                            <input name="image" class="file-input" id='image-input' onchange="handleImage(event)" type="file">
                                                                            <i class="icofont-cloud-upload text-primary upload-icon"></i>
                                                                        </label>
                                                                        <div class="text-center">
                                                                            <img id="image-preview" class="preview-image" src="{{$module->getFirstMediaUrl('modules')}}" alt=""> <br>
                                                                            <i id='delete-icon' class="icofont-ui-delete delete-image cursor-pointer" onclick="dropImage()"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-8 text-primary mx-auto">
                                                                    <div class="row border-group">
                                                                        <div class="col-6 form-group">
                                                                            <label for="title" class="required">Titre</label>
                                                                            <input value="{{$module->title}}" type="text" name="title" class="form-control input-default " >
                                                                        </div>
                                                                        <div class="col-6 form-group">
                                                                            <label for="youtube" class="required">Lien youtube</label>
                                                                            <input value="{{$module->youtube}}" type="url" name="youtube" class="form-control input-default " >
                                                                        </div>
                                                                        <div class="col-6 form-group">
                                                                            <label for="duration" class="required">Durée</label>
                                                                            <input value="{{$module->duration}}" type="number" min=0 name="duration" class="form-control input-default " >
                                                                        </div>
                                                                        <div class="col-12 text-left">
                                                                            <label for="description" class="">Description</label>
                                                                            <textarea id="summernote" class="summernote" name="description">
                                                                                {!! html_entity_decode($module->description) !!}
                                                                            </textarea>
                                                                        </div>

                                                                        <div class="col-12 mt-4 ">
                                                                            <label for="description" class="">Document</label>
                                                                            <div id="file-block-update" class="text-center">
                                                                                <label id="upload-doc-label-update" class="upload-doc-label  d-none">
                                                                                    <input name="documents[]" class="file-input" id='docs-input-update' type="file" multiple onchange="handleDocsUpdate(event)">
                                                                                    <i class="icofont-files-stack text-gray upload-icon"></i>
                                                                                </label>
                                                                                <div id="doc-preview-block-update" class="p-3 row doc-preview-block">
                                                                                    <div class="col-4 d-none" id='file-preview-update'>
                                                                                        <div>
                                                                                            <i class="icofont-file-alt doc-preview-icon"></i> <br>
                                                                                            <span>File</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    @foreach ($module->getMedia('documents') as $doc)
                                                                                        <div class="col-4" id='file-update'>
                                                                                            <div>
                                                                                                <i class="icofont-file-alt doc-preview-icon"></i> <br>
                                                                                                <span>{{$doc->name}}</span>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="mt-1" id='delete-block-update'>
                                                                                    <i class="icofont-ui-delete delete-image cursor-pointer" onclick="dropDocsUpdate()"></i>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="my-4 text-center">
                                                                        <button class="btn btn-primary">Enregistrer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$module->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$module->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un type d'évènement</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.module.forceDelete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="{{$module->id}}">
                                                            <div class="text-center text-black">
                                                                Êtes vous sûr de vouloir exécuter cette action ? <br/>
                                                                Celle ci supprimera toutes les entités liées à ce module !
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
                                <th>Titre</th>
                                <th>Cours</th>
                                <th>Durée</th>
                                <th>Nombre de document</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const uploadDocLabel = document.getElementById('upload-doc-label');
    const docPreviewBlock = document.getElementById('doc-preview-block');
    const deleteBlock = document.getElementById('delete-block');
    const handleDocs = (e)=>{
        if(e.target.files.length > 0){
            const filePreview = document.getElementById('file-preview');
            for(i=0; i<e.target.files.length; i++){
                let middle = filePreview.cloneNode(true);
                middle.id = 'file';
                middle.classList.remove('d-none');
                middle.children[0].children[2].innerHTML = e.target.files[i].name
                docPreviewBlock.appendChild(middle);
            }
            docPreviewBlock.classList.remove('d-none')
            deleteBlock.classList.remove('d-none')
            uploadDocLabel.classList.add('d-none')
        }
    }

    const dropDocs = ()=>{
        let DocsInput = document.getElementById('docs-input');
        DocsInput.value = '';
        docPreviewBlock.classList.add('d-none')
        deleteBlock.classList.add('d-none')
        uploadDocLabel.classList.remove('d-none')
        while (document.getElementById('file')) {
            document.getElementById('file').parentNode.removeChild(document.getElementById('file'));
        }
    }

    const docPreviewBlockUpdate = document.getElementById('doc-preview-block-update');
    const deleteBlockUpdate = document.getElementById('delete-block-update');
    const uploadDocLabelUpdate = document.getElementById('upload-doc-label-update');


    const handleDocsUpdate = (e)=>{
        if(e.target.files.length > 0){
            const filePreviewUpdate = document.getElementById('file-preview-update');
            for(i=0; i<e.target.files.length; i++){
                let middle = filePreviewUpdate.cloneNode(true);
                middle.id = 'file-update';
                middle.classList.remove('d-none');
                middle.children[0].children[2].innerHTML = e.target.files[i].name
                docPreviewBlockUpdate.appendChild(middle);
            }
            docPreviewBlockUpdate.classList.remove('d-none')
            deleteBlockUpdate.classList.remove('d-none')
            uploadDocLabelUpdate.classList.add('d-none')
        }
    }

    const dropDocsUpdate = ()=>{
        let DocsInputUpdate = document.getElementById('docs-input-update');
        DocsInputUpdate.value = '';
        docPreviewBlockUpdate.classList.add('d-none')
        deleteBlockUpdate.classList.add('d-none')
        uploadDocLabelUpdate.classList.remove('d-none')
        while (document.getElementById('file-update')) {
            document.getElementById('file-update').parentNode.removeChild(document.getElementById('file-update'));
        }
    }


</script>
@endsection

