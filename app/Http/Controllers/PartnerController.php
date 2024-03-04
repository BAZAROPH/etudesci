<?php

namespace App\Http\Controllers;

use App\Mail\CommercialEmail;
use App\Models\Partners;
use Illuminate\Http\Request;
use App\Mail\PartnerRequestEmail;
use Illuminate\Support\Facades\Mail;

class PartnerController extends Controller
{
    //
    public function adminIndex(){
        $partners = Partners::all();
        return view('admin.partners.index', [
            'partners' => $partners,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'contact' => 'required',
            'country' => 'required',
            'city' => 'required',
        ]);

        $partner = Partners::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact' => $request->contact,
            'company' => $request->company,
            'website' => $request->website,
            'country' => $request->country,
            'city' => $request->city,
        ]);

        if(!is_null($partner) and $request->file('file')){
            $partner->addMediaFromRequest('file')->toMediaCollection('partners');
        }
        Mail::to($partner->email)->send(new PartnerRequestEmail($partner));
        $data = [
            'first_name'=> 'Sara',
            'last_name'=> 'Tehua',
            'content'=> $partner->first_name.' '.$partner->last_name.' avec l\'email <span style="font-family: Arial; font-size: 17px;">'.$partner->email.'</span> et <br/> le contact <span style="font-family: Arial; font-size: 17px;">'.$partner->contact.'</span> vient de faire une nouvelle demande de partenariat',
        ];
        Mail::to('commercial@etudes.ci')->send(new CommercialEmail($data));
        return redirect()->route('home');
    }
}
