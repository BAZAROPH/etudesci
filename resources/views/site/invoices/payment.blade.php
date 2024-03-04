<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture - Etudes.ci</title>
</head>
<body class="">
    <div style="margin-inline: 20em;">
        <table style="width:100%;">
            <tr>
                <td style="width: 50%; vertical-align:top;" rowspan="5">
                    {{-- {{dd(public_path('/site/assets/blue-logo.png'))}} --}}
                    <img src="{{public_path('/public/site/assets/blue-logo.png')}}" style="height: 5em" alt="">
                </td>
                <td style="text-align: right">
                    <span style="color: #143F7C; font-weight:bold; font-size:1.5em;">Reçu de paiement</span>
                </td>
            </tr>
            <tr>
                <td style="text-align:right; font-size: 1.1em;">
                    Date: <span style="font-weight:bold;">{{$payment->Date()}}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align:right; font-size: 1.1em; padding-top:1em;">
                    Reçu N°: <span style="font-weight:bold; text-transform: uppercase;">{{$payment->invoice}}</span>
                </td>
            </tr>
            <tr>
                <td style="text-align:right; font-size: 1.1em; padding-top:1.3em;">
                    <span style="font-weight:bold;">Contact Facturation</span>
                </td>
            </tr>
            <tr>
                <td style="text-align:right; font-size: 1.1em; padding-top:1.3em; text-transform: uppercase;">
                    <span style="font-weight:bold; ">Client: </span> {{$user->last_name}} {{$user->first_name}}
                </td>
            </tr>
        </table>

        <table style="margin-top:2em;  width:100%; border-collapse: collapse" border="1">
            <thead style="color:white; background-color:#143F7C;">
                <tr style="width:100%;">
                    <th style="text-align:left; padding-left:10px; padding:1.2em;">Désignation</th>
                    <th>Prix</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="" style="text-transform: uppercase; padding-left: 10px; padding:1.2em">{{$product['author']}}</td>
                    <td colspan="" style="text-align: center;"></td>
                    <td colspan="" style="text-align: center;"></td>
                </tr>
                <tr>
                    <td colspan="" style="text-transform: uppercase; padding-left: 10px; padding:1.2em">{{$product['label']}}</td>
                    <td colspan="" style="text-align: center;">@money($payment->amount)</td>
                    <td colspan="" style="text-align: center;">@money($payment->amount)</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-transform: uppercase; padding-left: 10px; padding:1em">Remise</td>
                    <td colspan="" style="text-align: center;">@money($payment->reduction)</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-transform: uppercase; padding-left: 10px; padding:1em">Total TTC</td>
                    <td colspan="" style="text-align: center;">@money($payment->amount)</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-transform: uppercase; padding-left: 10px; padding:1em">Montant Payé</td>
                    <td colspan="" style="text-align: center;">@money($payment->amount)</td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 2em;">NB: Le montant payé n'est pas remboursable</div>

        <p style="font-size: 0.8em; text-align:center; font-weight:bold; margin-top:25em;">Cocody, Angré CNPS, Cité Star 12 - 12 -19 BP 1100 ABIDJAN 19 * Contact :225  07 00 77 33 04 / 05 96 67 49 67 / 22 24 30 97 80 <br>
            *RCCM: CI- ABJ-03-2022- b12-02297 -etudes@etudes.ci - www.etudes.ci
        </p>
    </div>
</body>
</html>
