<?php

use App\Models\User;
use App\Models\OnlineClass;
use Illuminate\Support\Carbon;
use App\Mail\DispatchTokenEmail;
use App\Mail\RelanceEmails;
use App\Mail\relancePotentialEmail1;
use App\Mail\relancePotentialEmail2;
use App\Mail\relancePotentialEmail3;
use App\Mail\relancePotentialEmail4;
use Illuminate\Support\Facades\Mail;

    function dispatchToken(){
        $onlineClass = OnlineClass::whereDate('date', '>=', Carbon::now()->subHours(3))->where('type', 'onlineclass')->orderBy('date', 'ASC')->first();
        if(!is_null($onlineClass)){
            $path = $onlineClass->getFirstMedia('tokens')->getPath();
            if(!is_null($path)){
                $file = fopen($path, 'r');
                fgetcsv($file);
                while (($line = fgetcsv($file)) !== false) {
                    $data[] = str_replace(';', '', $line);
                }
                // Fermer le fichier CSV
                fclose($file);

                $users = User::whereHas('subscription', function($query){
                    $query->where('state', '>=', 1);
                })->get();

                for ($i=0; $i < count($users) ; $i++) {
                    $users[$i]->update([
                        'token' => $data[$i][0]
                    ]);
                }
            }
        }
    }


    function sendRelancePotencialEmail(){
        $potentials = User::where('flag', 'subscriber_potential')->get();
        $onlineclasses = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->limit(3)->get();
        for ($i=0; $i < count($potentials) ; $i++) {
            $data = [
                'first_name' => $potentials[$i]->first_name,
            ];
            if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 0 ){
                if(isset($onlineclasses[0]) and isset($onlineclasses[0]->code)){
                    $code = $onlineclasses[0]->code;
                    $code = str_replace('data_firstname', $potentials[$i]->first_name, $code);
                    $code = str_replace('data_lastname', $potentials[$i]->last_name, $code);
                    $code = str_replace('data_email', $potentials[$i]->email, $code);
                    $code = str_replace('data_phone', $potentials[$i]->contact, $code);
                    Mail::to($potentials[$i])->send(new RelanceEmails($code));
                    Mail::to('etudes@etudes.ci')->send(new RelanceEmails($code));
                }
            }
            else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 1){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail2($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail2($data));
                if(isset($onlineclasses[0]) and isset($onlineclasses[0]->code)){
                    $code = $onlineclasses[0]->code;
                    $code = str_replace('data_firstname', $potentials[$i]->first_name, $code);
                    $code = str_replace('data_lastname', $potentials[$i]->last_name, $code);
                    $code = str_replace('data_email', $potentials[$i]->email, $code);
                    $code = str_replace('data_phone', $potentials[$i]->contact, $code);
                    Mail::to($potentials[$i])->send(new RelanceEmails($code));
                    Mail::to('etudes@etudes.ci')->send(new RelanceEmails($code));
                }
            }
            else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 2){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail3($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail3($data));
                if(isset($onlineclasses[1]) and isset($onlineclasses[1]->code)){
                    $code = $onlineclasses[0]->code;
                    $code = str_replace('data_firstname', $potentials[$i]->first_name, $code);
                    $code = str_replace('data_lastname', $potentials[$i]->last_name, $code);
                    $code = str_replace('data_email', $potentials[$i]->email, $code);
                    $code = str_replace('data_phone', $potentials[$i]->contact, $code);
                    Mail::to($potentials[$i])->send(new RelanceEmails($code));
                    Mail::to('etudes@etudes.ci')->send(new RelanceEmails($code));
                }
            }else if(Carbon::parse($potentials[$i]->created_at)->diffInDays(Carbon::now()) == 3){
                // Mail::to('etudes@etudes.ci')->send(new relancePotentialEmail4($data));
                // Mail::to($potentials[$i])->send(new relancePotentialEmail4($data));
                if(isset($onlineclasses[2]) and isset($onlineclasses[2]->code)){
                    $code = $onlineclasses[0]->code;
                    $code = str_replace('data_firstname', $potentials[$i]->first_name, $code);
                    $code = str_replace('data_lastname', $potentials[$i]->last_name, $code);
                    $code = str_replace('data_email', $potentials[$i]->email, $code);
                    $code = str_replace('data_phone', $potentials[$i]->contact, $code);
                    Mail::to($potentials[$i])->send(new RelanceEmails($code));
                    Mail::to('etudes@etudes.ci')->send(new RelanceEmails($code));
                }
            }
        }
    }

    function validateFormat($contact){
        $contact = str_replace('-', '', $contact);
        $contact = str_replace( ' ', '', $contact);
        $contact = str_replace('+', '', $contact);
        $contact = str_replace('(', '', $contact);
        $contact = str_replace(')', '', $contact);

        $prefix = substr($contact, 0, 4);
        // dd($prefix);;
        if(substr($prefix, 0, 2) == '00' and substr($prefix, 1, 4) == '22'){
            $contact = substr($contact, 2, strlen($contact));
        }else if(strlen($contact) == 10){
            $contact = '225'.$contact;
        }
        return $contact;
    }

?>
