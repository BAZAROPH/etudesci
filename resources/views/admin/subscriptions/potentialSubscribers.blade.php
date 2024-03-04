@extends('admin.base', [
    'title' => 'Liste des Abonnés',
    'active' => 'subscribers',
    'subActive' => 'potential-subscribers-list'
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
                <h4 class="card-title">Liste des Abonnés</h4>
                <a href="{{route('admin.potentials-users-emails')}}" class="mr-2">
                    <button class="btn btn-success text-white" >Télécharger les emails en csv</button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date d'insciption</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elements as $potential)
                                <tr class="text-center">
                                    <td>{{$potential->id}}</td>
                                    <td>{{$potential->last_name}}</td>
                                    <td>{{$potential->first_name}}</td>
                                    <td>{{$potential->email}}</td>
                                    <td>{{$potential->contact}}</td>
                                    <td>
                                        {{$potential->created_at}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Date d'insciption</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
