@extends('admin.base', [
    'title' => 'Liste des demandes de partenariats',
    'active' => 'partners',
    'subActive' => 'partners-list'
])

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Liste des demandes de partenariats</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Numéro</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Société</th>
                                <th>Pays</th>
                                <th>Ville</th>
                                <th>Document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($partners as $partner)
                                <tr class="text-center">
                                    <td>{{$partner->id}}</td>
                                    <td>{{$partner->last_name}}</td>
                                    <td>{{$partner->first_name}}</td>
                                    <td>{{$partner->email}}</td>
                                    <td>{{$partner->contact}}</td>
                                    <td>{{$partner->company}}</td>
                                    <td>{{$partner->country}}</td>
                                    <td>{{$partner->city}}</td>
                                    <td class="text-truncate">
                                        @if($partner->getFirstMediaUrl('partners'))
                                            <a href="{{$partner->getFirstMediaUrl('partners')}}">
                                                <button class="btn btn-primary">Télécharger</button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>Numéro</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Société</th>
                                <th>Pays</th>
                                <th>Ville</th>
                                <th>Document</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
