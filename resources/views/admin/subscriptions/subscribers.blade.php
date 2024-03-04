@extends('admin.base', [
    'title' => 'Liste des Abonnés',
    'active' => 'subscribers',
    'subActive' => 'subscribers-list'
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

            </div>
            <div class="text-right mr-2">
                <a href="{{route('admin.get-subscribers')}}" class="mr-2">
                    <button class="btn btn-success text-white" >Liste des abonnés</button>
                </a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#newSubscriber">Ajouter un(e) abonné(e)</button>
                 <!-- Modal -->
                <div class="modal fade" id="newSubscriber" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter un nouvel abonné</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('admin.addSubscriber')}}" method="post">
                                @csrf
                                <div class="modal-body">
                                    <select name="email" class="multi-select text-left form form-control" id="">
                                        @foreach ($users as $user)
                                            <option value="{{$user->email}}">{{$user->email}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="referenceNumber" id='references'>
                                    <div class="my-2">
                                        <label for="" class="required">Montant</label>
                                        <input type="text" class="form form-control" name="amount">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary">Ajouter aux abonnés</button>
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
                                <th>Id</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Début d'abonnement</th>
                                <th>Fin d'abonnement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscribers as $subscriber)
                                <tr class="text-center">
                                    <td>{{$subscriber->id}}</td>
                                    <td>{{$subscriber->last_name}}</td>
                                    <td>{{$subscriber->first_name}}</td>
                                    <td>{{$subscriber->email}}</td>
                                    <td>{{$subscriber->contact}}</td>
                                    <td>{{$subscriber->Subscription->start}}</td>
                                    <td>{{$subscriber->Subscription->end}}</td>
                                    <td>
                                        {{-- @if($subscriber->Subscription->state == 1 or $subscriber->Subscription->state == 2) --}}
                                    <span class="bg-success text-white p-2 rounded">En cours de validité</span>
                                        {{-- @else --}}
                                            {{-- <span class="bg-danger text-white p-2 rounded">Expiré</span> --}}
                                        {{-- @endif --}}
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
                                <th>Début d'abonnement</th>
                                <th>Fin d'abonnement</th>
                                <th>Statut</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function generateTimestampKey() {
        return new Date().getTime().toString();
    }
    document.getElementById('references').value = generateTimestampKey();
</script>
@endsection
