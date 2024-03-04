@extends('admin.base', [
    'title' => 'Liste des certifications',
    'active' => 'certifications',
    'subActive' => 'certifications-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des certifications</h4>
                <a href="{{route('admin.certification.create')}}">
                    <button class="btn btn-primary">Ajouter une certification</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Identifiant</th>
                                <th>Photo</th>
                                <th>Cabinet</th>
                                <th>Prix</th>
                                <th>Réduction</th>
                                <th>Début</th>
                                <th>Fin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certifications as $certification)
                                <tr class="text-center">
                                    <td>{{$certification->id}}</td>
                                    <td>
                                        <img class='author-photo' src="{{$certification->getFirstMediaUrl('certifications')}}" alt="">
                                    </td>
                                    <td>{{$certification->Office->name}}</td>
                                    <td>{{$certification->price}}</td>
                                    <td>{{$certification->reduction}}</td>
                                    <td>{{$certification->start_date}}</td>
                                    <td>{{$certification->end_date}}</td>
                                    <td>
                                        <a href="{{$certification->editUrl()}}">
                                            <button data-toggle="modal" class="btn btn-success text-white">Modifier</button>
                                        </a>
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$certification->id}}">Supprimer</button>
                                        <!-- DELETE Modal -->
                                        <div class="modal fade" id="deleteModal{{$certification->id}}">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Supprimer un d'auteurs</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{route('admin.certification.delete')}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="slug" value="{{$certification->slug}}">
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
                                <th>Cabinet</th>
                                <th>Prix</th>
                                <th>Réduction</th>
                                <th>Début</th>
                                <th>Fin</th>
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
