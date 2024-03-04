@extends('admin.base', [
    'title' => 'Liste des Abonnements',
    'active' => 'subscription',
    'subActive' => 'subscription-list'
])

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des Abonnements</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display" style="min-width: 845px">
                            <thead>
                                <tr class="text-center">
                                    <th>Références de paiement</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Date de paiement</th>
                                    <th>Début d'abonnement</th>
                                    <th>Fin d'abonnement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr class="text-center">
                                       <td>{{$subscription->references}}</td>
                                       <td>{{$subscription->User->last_name}} {{$subscription->User->first_name}}</td>
                                       <td>{{$subscription->amount}}</td>
                                       <td>
                                            @if ($subscription->state >= 1)
                                                <span  class="p-2 rounded bg-success text-white">Effectué</span>
                                            @elseif ($subscription->state == -1)
                                                <span  class="p-2 rounded bg-danger text-white">Expiré</span>
                                            @else
                                                <span  class="p-2 rounded bg-warning text-white">En attente</span>
                                            @endif
                                        </td>
                                       <td>{{$subscription->pay_at}}</td>
                                       <td>{{$subscription->start}}</td>
                                       <td>{{$subscription->end}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <th>Références de paiement</th>
                                    <th>Client</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                    <th>Date de paiement</th>
                                    <th>Début d'abonnement</th>
                                    <th>Fin d'abonnement</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
