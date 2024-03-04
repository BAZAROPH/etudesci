<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Courses;
use App\Mail\RelanceEmails;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Mail\DispatchTokenEmail;
use App\Mail\RegisterConfirmEmail;
use App\Mail\SubscriptionPaidEmail;
use App\Mail\relancePotentialEmail1;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\Subscription;
use Illuminate\Support\Facades\Redirect;
require_once app_path('functions.php');

class SubscriptionController extends Controller
{
    //
    public function adminIndex(){
        $subscriptions = Subscriptions::orderBy('pay_at', 'desc')->get();
        return view('admin.subscriptions.subscriptions', [
            'subscriptions' => $subscriptions,
        ]);
    }

    public function description(){
        // $nextOnlineClasses = OnlineClass::where('date', '>=', Carbon::now())->where('type', 'onlineclass')->get();
        $nextOnlineClasses = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->get();

        $subscription = null;
        if(Auth::check()){
            if(Auth::user()->Subscription){
                $subscription = Subscriptions::where('user', Auth::user()->id)->where('state', '>=', 1)->latest()->first();
            }
        }

        $replays = Courses::where('type', 'onlineclass')->where('published', 1)->get();
        return view('site.subscriptions.description', [
            'nextOnlineClasses' => $nextOnlineClasses,
            'replays' => $replays,
            'subscription' => $subscription,
        ]);
    }

    public function payment(){
        return view('site.subscriptions.payment');
    }

    public function login (Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($request->password),
            'flag' => 'subscriber_potential',
            'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16)),
        ]);
        Auth::login($user);

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

    public function preprocess(Request $request){
        $request->validate([
            'id' => 'required',
            'token' => 'required',
        ]);

        $user = User::find($request->id);

        if(!is_null($user)){
            Subscriptions::where('user', $request->id)->where('state', 0)->forceDelete();

            $subscription = Subscriptions::create([
                'amount' => 14900,
                'user' => $user->id ,
                'token' => $request->token,
                'state' => 0
            ]);

            $user->update([
                'contact' => $request->contact,
            ]);

            if (!is_null($subscription)) {
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

        $subscription = Subscriptions::where('token', '!=', null)->where('token', $request->referenceNumber)->first();
        if(!is_null($subscription) && $request->responsecode != -1){
            $valideSubscription = Subscriptions::where('user', $subscription->user)->where('state', 1)->first();
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
            dispatchToken();
            return view('site.subscriptions.response', [
                'error' => false
            ]);
        }else if($request->responsecode == -1){
            return view('site.subscriptions.response', [
                'error' => true
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function redirection(){
        $potentials = User::where('flag', 'subscriber_potential')->get();
        // dd($potentials);
        for ($i=0; $i < count($potentials) ; $i++) {
            $data = [
                'first_name' => $potentials[$i]->first_name,
            ];
            dd(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()));
            if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 1 ){
                Mail::to($potentials[$i])->send(new relancePotentialEmail1($data));
            }
            // else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 2){
            //     Mail::to($potentials[$i])->send(new relancePotentialEmail2($data));
            // }else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 3){
            //     Mail::to($potentials[$i])->send(new relancePotentialEmail3($data));
            // }else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 4){
            //     Mail::to($potentials[$i])->send(new relancePotentialEmail4($data));
            // }
        }
    }

    // function dispatchToken(){
    //     $users = User::whereHas('subscription', function($query){
    //         $query->where('state', '>=', 1);
    //     })->where('token', '!=', null)->get();
    //     $onlineClass = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->orderBy('date', 'ASC')->first();
    //     if(!is_null($onlineClass)){
    //         $onWeekBefore = Carbon::parse($onlineClass->date)->subWeek()->format('Y-m-d');
    //         $oneDayBefore = Carbon::parse($onlineClass->date)->subDay()->format('Y-m-d');
    //         $today = Carbon::parse($onlineClass->date)->format('Y-m-d');
    //         if(($onWeekBefore == Carbon::now()->format('Y-m-d')  and Carbon::now()->format('H:i') === '08:00') or ($oneDayBefore == Carbon::now()->format('Y-m-d') and Carbon::now()->format('H:i') == '11:16') or ($today == Carbon::now()->format('Y-m-d') and Carbon::now()->format('H:i') == '08:00')){
    //             for ($i=0; $i < count($users) ; $i++) {
    //                 $data = [
    //                     'first_name' => $users[$i]->first_name,
    //                     'trainer' => $onlineClass->Trainer->first_name.' '.$onlineClass->Trainer->last_name,
    //                     'token' => $users[$i]->token,
    //                     'date' => Carbon::parse($onlineClass->date)->translatedFormat('d F Y'),
    //                     'hour' => $onlineClass->hour,
    //                     'onlineClass' => $onlineClass->title,
    //                     'image' => $onlineClass->getFirstMediaUrl('onlineClass'),
    //                     'link' => route('onlineClass.open', $onlineClass->slug),
    //                 ];
    //                 Mail::to($users[$i]->email)->send(new DispatchTokenEmail($data));
    //             }
    //             Mail::to('bazaroph@gmail.com')->send(new DispatchTokenEmail($data));
    //         }
    //     }
    // }

    function test(){
        $potentials = User::where('flag', 'subscriber_potential')->get();
        $onlineclasses = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->limit(3)->get();
        for ($i=0; $i < count($potentials) ; $i++) {
            $data = [
                'first_name' => $potentials[$i]->first_name,
            ];
            if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 0 ){
                if(isset($onlineclasses[0]) and isset($onlineclasses[0]->code)){
                    Mail::to($potentials[$i])->send(new RelanceEmails($data, $onlineclasses[0]->code));
                }
            }
            else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 1){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail2($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail2($data));
                if(isset($onlineclasses[0]) and isset($onlineclasses[0]->code)){
                    Mail::to($potentials[$i])->send(new RelanceEmails($data, $onlineclasses[0]->code));
                }
            }
            else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 2){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail3($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail3($data));
                if(isset($onlineclasses[1]) and isset($onlineclasses[1]->code)){
                    Mail::to($potentials[$i])->send(new RelanceEmails($data, $onlineclasses[0]->code));
                }
            }else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 3){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail4($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail4($data));
                if(isset($onlineclasses[2]) and isset($onlineclasses[2]->code)){
                    Mail::to($potentials[$i])->send(new RelanceEmails($data, $onlineclasses[0]->code));
                }
            }
        }
    }

}
