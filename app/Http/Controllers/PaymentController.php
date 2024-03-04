<?php

namespace App\Http\Controllers;

use App\Mail\OfficePaymentEmail;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Events;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Illuminate\Support\Carbon;
use App\Mail\PaymentInvoiceEmail;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    //

    public function adminIndex(){
        $payments = Payments::orderBy('created_at', 'ASC')->get();
        return view('admin.payments.index', [
            'payments' => $payments,
        ]);
    }

    public function index($type, $slug){
        if($type == 'event'){
            $event = Events::where('slug', $slug)->first();

            $product = [
                'label' => $event->name,
                'premium_price' => $event->premium_price,
                'price' => $event->reduction ? $event->price - ($event->price * ($event->reduction/100)) : $event->price,
                'slug' => $event->slug,
            ];
        }else if($type == 'certification') {
            $certification = Certifications::where('slug', $slug)->first();
            $product = [
                'label' => $certification->title,
                'premium_price' => $certification->premium_price,
                'price' => $certification->reduction ? $certification->price - ($certification->price * ($certification->reduction/100)) : $certification->price,
                'slug' => $certification->slug,
            ];
        }

        return view('site.pay.pay', [
            'type' => $type,
            'product' => $product,
            'now' =>  Carbon::now(),
        ]);
    }

    public function paid(Request $request){
        $request->validate([
            'id' => 'required',
            'token' => 'required',
            'amount' => 'required',
            'product_type' => 'required',
            'slug' => 'required'
        ]);
        $user = User::find($request->id);

        if($request->product_type == 'certification'){
            $product = Certifications::where('slug', $request->slug)->first();
        }else{
            $product = Events::where('slug', $request->slug)->first();
        }

        if(!is_null($user)){
            Payments::where('user', $request->id)->where('state', 0)->forceDelete();

            $payments = Payments::create([
                'amount' => $request->amount,
                'user' => $user->id ,
                'token' => $request->token,
                'state' => 0,
                'product_type' => $request->product_type,
                'product_id' => $product->id,
            ]);

            if(!is_null($request->contact)){
                $user->update([
                    'contact' => $request->contact,
                ]);
            }

            if (!is_null($payments)) {
                return response()->json([
                    'success' => true
                ]);
            }
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function validatePayment(Request $request){
        $request->validate([
            'referenceNumber' => 'required',
        ]);
        $payment = Payments::where('token', '!=', null)->where('token', $request->referenceNumber)->first();
        if(!is_null($payment) && $request->responsecode != -1){
            $prefix = 'MYP-'; // Préfixe pour le numéro de facture
            $length = 6; // Longueur maximale du numéro de facture (sans le préfixe)
            // Génère un numéro de facture unique
            $number = $prefix . str_pad(mt_rand(1, pow(10, $length)-1), $length, '0', STR_PAD_LEFT) . '-' . uniqid();

            $payment->update([
                'invoice' => $number,
                'state' => 1,
                'references' => $request->referenceNumber,
                'token' => null,
                'pay_at' => now()
            ]);

            if($payment->product_type == 'certification'){
                $certification = Certifications::find($payment->product_id);
                $product = [
                    'label' => $certification->title,
                    'author' => $certification->Office->name,
                    'author_email' => $certification->Office->email,
                    'type' => $payment->product_type,
                    'date' => Carbon::parse($certification->start_date)->format('d-m-Y'),
                    'hour' => Carbon::parse($certification->start_date)->format('h:i'),
                    'office_money' => $certification->office_money,
                    'reduction' =>  $certification->reduction ? $certification->price * ($certification->reduction/100) : 0,
                ];
            }else{
                $event = Events::find($payment->product_id);
                $product = [
                    'label' => $event->title,
                    'author' => $event->Organizer->name,
                    'author_email' => $event->Organizer->email,
                    'type' => $payment->product_type,
                    'date' => Carbon::parse($event->start_date)->format('d-m-Y'),
                    'hour' => Carbon::parse($event->start_date)->format('h:i'),
                    'office_money' => $event->office_money,
                    'reduction' =>  $event->reduction ? $event->price * ($event->reduction/100) : 0,
                ];
            }

            $data = [
                'user' => User::find($payment->user),
                'payment' => $payment,
                'product' => $product
            ];

            $dompdf = new Dompdf();
            $dompdf->getOptions()->isRemoteEnabled(true);
            $dompdf->loadHtml(view('site.invoices.payment', $data)->render());
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $pdfString = $dompdf->output();

            Mail::to($payment->User->email)->send(new PaymentInvoiceEmail($product, $pdfString));
            Mail::to($product['author_email'])->send(new OfficePaymentEmail($product));

            return view('site.pay.response', [
                'error' => false,
                'product' => $product,
                'type' => $payment->product_type,
            ]);
        }else if($request->responsecode == -1){
            return view('site.pay.response', [
                'error' => true,
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function generate(){
        // return view('site.invoices.payment');
        $data = [
            'title' => 'Mon premier PDF avec Laravel'
        ];
        $dompdf = new Dompdf();
        $dompdf->getOptions()->isRemoteEnabled(true);
        $dompdf->loadHtml(view('site.invoices.payment', $data)->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('mon-fichier-pdf.pdf');
    }
}
