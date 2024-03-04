@extends('admin.base', [
    'title' => 'Liste des paiements',
    'active' => 'payments',
    'subActive' => 'payments-list'
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
                <h4 class="card-title">Liste des Paiements</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="min-width: 845px">
                        <thead>
                            <tr class="text-center">
                                <th>Références</th>
                                <th>N° Facture</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Id Produit</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                                <tr class="text-center">
                                    <td>{{$payment->references}}</td>
                                    <td>{{$payment->invoice}}</td>
                                    <td>{{$payment->User->last_name}}</td>
                                    <td>{{$payment->User->first_name}}</td>
                                    <td>{{$payment->product_type}}</td>
                                    <td>{{$payment->pay_at}}</td>
                                    <td>{{$payment->product_id}}</td>
                                    <td>@money($payment->amount)</td>
                                    <td>
                                        @if ($payment->state == 1)
                                            <span  class="p-2 rounded bg-success text-white">Effectué</span>
                                        @else
                                            <span  class="p-2 rounded bg-warning text-white">En attente</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>Références</th>
                                <th>N° Facture</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Produit</th>
                                <th>Montant</th>
                                <th>Statut</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
