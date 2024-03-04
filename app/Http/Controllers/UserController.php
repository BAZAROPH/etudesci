<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Roles;
use App\Models\Events;
use League\Csv\Writer;
use App\Models\Courses;
use App\Models\Payments;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Models\Certifications;
use Illuminate\Support\Carbon;
use App\Mail\RegisterConfirmEmail;
use App\Mail\SubscriptionPaidEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    public function adminIndex(){
        // $users = User::whereHas('role', function($query){
        //     $query->where('label', 'admin');
        // })->get();
        $users = User::whereNull('role')->get();
        return view('admin.users.index', [
            'users'=> $users,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'contact' => 'required|unique:users,contact',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $role = Roles::where('label', 'admin')->first();
        $user = User::create([
            'last_name' => $request->last_name,
            'name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'password' => $request->password,
            'role' => $role->id,
            'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16)),
        ]);
        if(!is_null($user)){
            $user = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'url' => route('confirm-email', $user->email_verify_token),
            ];
            Mail::to($user['email'])->send(new RegisterConfirmEmail($user));
        }
        return redirect()->back();
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
        ]);

        $role = Roles::where('label', 'admin')->first();
        $user = User::find($request->id);

        $user->update([
            'last_name' => $request->last_name,
            'name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'role' => $role->id,
        ]);

        if(!is_null($request->password)){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->back();
    }

    public function adminDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $user = User::find($request->id);
        $user->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $users = User::onlyTrashed()->whereHas('role', function($query){
            $query->where('label', 'admin');
        })->get();
        return view('admin.users.trash', [
            'users'=> $users,
        ]);
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $user = User::onlyTrashed()->find($request->id);
        $user->forceDelete();
        return redirect()->back();
    }

    public function adminRestore($id){
        User::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }

    public function addSubscriberInAmin(Request $request){
        $request->validate([
            'referenceNumber' => 'required',
            'email' => 'required|email',
            'amount' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();
        Subscriptions::where('user', $user->id)->where('state', 0)->forceDelete();
        $subscription = Subscriptions::create([
            'amount' => $request->amount,
            'user' => $user->id ,
            'token' => $request->referenceNumber,
            'state' => 1,
            'start' => Carbon::now(),
        ]);

        if(!is_null($subscription) && $request->responsecode != -1){
            $valideSubscription = $subscription;
            if(!is_null($valideSubscription)){
                $subscription->update([
                    'state' => 1,
                    'references' => $request->referenceNumber,
                    'token' => null,
                    'start' => $valideSubscription->start,
                    'end' => Carbon::parse($valideSubscription->end)->addMonth(1),
                    'pay_at' => now()
                ]);

                $valideSubscription->update([
                    'state' => 2,
                ]);
            }else{
                $subscription->update([
                    'state' => 1,
                    'references' => $request->referenceNumber,
                    'token' => null,
                    'start' => Carbon::now(),
                    'end' => Carbon::now()->addMonth(1),
                    'pay_at' => now()
                ]);
            }
            $onlineClasses = OnlineClass::where('date', '>', Carbon::now())->orderBy('date', 'DESC')->orderBy('hour', 'DESC')->limit(3)->get();
            for ($i=0; $i < count($onlineClasses) ; $i++) {
                $onlineClasses[$i]->date = Carbon::parse($onlineClasses[$i]->date)->translatedFormat('d F');
            }
            User::find($subscription->user)->update([
                'flag' => null,
            ]);
            Mail::to($subscription->User->email)->send(new SubscriptionPaidEmail($onlineClasses));
            require_once app_path('functions.php');
            dispatchToken();
            return redirect()->back();
        }else if($request->responsecode == -1){
            return view('site.subscriptions.response', [
                'error' => true
            ]);
        }else{
            return redirect()->route('home');
        }
    }


    public function space(){
        $subscription = Subscriptions::where('user', Auth::user()->id)->latest()->first();
        $certifications = Certifications::orderBy('created_at', 'DESC')->get();
        $events = Events::whereDate('start_date', '>=', Carbon::now())->where('published', 1)->get();
        $nextOnlineClasses = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->get();
        // $previousOnlineClasses = OnlineClass::where('date', '<=', Carbon::now())->where('type', 'onlineclass')->get();
        $replays = Courses::where('type', 'onlineclass')->where('published', 1)->get();
        $actif = $subscription->state >= 1;
        return view('site.space.space', [
            'subscription' => $subscription,
            'certifications' => $certifications,
            'events' => $events,
            'actif' => $actif,
            'nextOnlineClasses' => $nextOnlineClasses,
            'replays' => $replays,
        ]);
    }

    public function subscribers(){
        $subscribers = User::whereHas('Subscription', function($query){
            $query->where('state', '>=', 1);
        })->get();
        $users = User::whereDoesntHave('Subscription')->orWhereHas('Subscription', function($query){
            $query->where('state', '<=', 0);
        })->get();
        return view('admin.subscriptions.subscribers', [
            'subscribers' => $subscribers,
            'users' => $users,
        ]);
    }

    public function purchases(){
        $payments = Payments::where('user', Auth::user()->id)->get();
        $elements = [];
        foreach ($payments as $payment) {
            if($payment->product_type == 'certification'){
                $certification = Certifications::find($payment->product_id);
                $element = [
                    'id' => $payment->id,
                    'type' => $payment->product_type,
                    'author' => $certification->Office->name,
                    'contact' => $certification->Office->contact,
                    'email' => $certification->Office->email,
                    'image' => $certification->getFirstMediaUrl('certifications'),
                ];
                array_push($elements, $element);
            }else{
                $event = Events::find($payment->product_id);
                $element = [
                    'id' => $payment->id,
                    'type' => $payment->product_type,
                    'author' => $event->Organizer->name,
                    'contact' => $event->Organizer->contact,
                    'email' => $event->Organizer->email,
                    'image' => $event->getFirstMediaUrl('events'),
                ];
                array_push($elements, $element);
            }
        }
        return view('site.space.purchases', [
            'payments' => $elements,
        ]);
    }

    public function downloadInvoice($payment_id){
        $payment = Payments::find($payment_id);
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

        return $dompdf->stream('mon-fichier-pdf.pdf');
    }

    public function potentialSubscribers(){
        $elements = User::where('flag', 'subscriber_potential')->get();
        return view('admin.subscriptions.potentialSubscribers', [
            'elements' => $elements,
        ]);
    }

    public function getUsersEmail(){
        $users = User::whereNull('role')->select('email')->get();
        $writer = Writer::createFromString('');
        foreach ($users as $key => $user) {
            $writer->insertOne([$user->email]);
        }
        // $writer1->insertAll($valid_contacts);
        $csv = $writer->getContent();
        $filename = 'Liste des emails.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $final_csv = $csv;
        return response()->streamDownload(function () use ($final_csv){
            echo $final_csv;
        }, $filename, $headers);
    }

    public function getPotentialSubscribers(){
        $users = User::where('flag', 'subscriber_potential')->get();
        $writer = Writer::createFromString('');
            $writer->insertOne(['N°', 'email', 'contact', 'Nom', 'Prénom']);
            foreach ($users as $key => $user) {
            $writer->insertOne([$key+1, $user->email, $user->contact, $user->last_name, $user->first_name]);
        }
        // $writer1->insertAll($valid_contacts);
        $csv = $writer->getContent();
        $filename = 'Liste des potentiels abonnés.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $final_csv = $csv;
        return response()->streamDownload(function () use ($final_csv) {
            echo $final_csv;
        }, $filename, $headers);
    }

    public function getSubscribers(){
        $users = User::whereHas('Subscription', function($query){
            $query->where('state', '>=', 1);
        })->get();;
        $writer = Writer::createFromString('');
            $writer->insertOne(['N°', 'email', 'contact', 'Nom', 'Prénom']);
            foreach ($users as $key => $user) {
            $writer->insertOne([$key+1, $user->email, $user->contact, $user->last_name, $user->first_name]);
        }
        // $writer1->insertAll($valid_contacts);
        $csv = $writer->getContent();
        $filename = 'Liste des abonnés.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $final_csv = $csv;
        return response()->streamDownload(function () use ($final_csv) {
            echo $final_csv;
        }, $filename, $headers);
    }
}
