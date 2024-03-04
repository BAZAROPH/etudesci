<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Trainers;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\DispatchTokenEmail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OnlineClassController extends Controller
{
    //
    public function open($slug){
        $onlineClass = OnlineClass::where('slug', $slug)->first();
        $ready = Carbon::parse($onlineClass->date.' '.$onlineClass->hour) < Carbon::now();
        return view('site.subscriptions.onlineclass.meet', [
            'onlineClass' => $onlineClass,
            'ready' => $ready,
        ]);
    }

    public function adminIndex(){
        $onlineClasses = OnlineClass::orderBy('date', 'ASC')->get();
        return view('admin.onlineclass.index', [
            'onlineClasses' => $onlineClasses,
        ]);
    }

    public function adminCreate(){
        $trainers = Trainers::orderBy('last_name', 'ASC')->get();

        return view('admin.onlineclass.create', [
            'trainers' => $trainers,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'title' => 'required',
            'trainer' => 'required',
            'description' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'script' => 'required',
            'type' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'tokens.*' => 'mimes:csv',
        ]);

        $onlineClass = OnlineClass::create([
            'title' => $request->title,
            'slug' => SlugService::createSlug(OnlineClass::class, 'slug', $request->title),
            'trainer' => $request->trainer,
            'description' => $request->description,
            'date' => $request->date,
            'hour' => $request->hour,
            'script' => $request->script,
            'type' => $request->type,
            'code' => $request->code
        ]);

        if(!is_null($onlineClass)){
            $onlineClass->addMediaFromRequest('image')->toMediaCollection('onlineClass');
            $onlineClass->addMediaFromRequest('tokens')->toMediaCollection('tokens');
        }

        return redirect()->route('admin.onlineClass.index');
    }

    public function adminEdit($slug){
        $trainers = Trainers::orderBy('last_name', 'ASC')->get();
        $onlineClass = OnlineClass::where('slug', $slug)->first();
        return view('admin.onlineclass.update', [
            'onlineClass' => $onlineClass,
            'trainers' => $trainers,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'trainer' => 'required',
            'description' => 'required',
            'date' => 'required',
            'hour' => 'required',
            'script' => 'required',
            'slug' => 'required',
            'type' => 'required',
            'tokens.*' => 'mimes:csv',
        ]);

        $onlineClass = OnlineClass::where('slug', $request->slug)->first();
        $onlineClass->update([
            'title' => $request->title,
            // 'slug' => SlugService::createSlug(OnlineClass::class, 'slug', $request->title),
            'trainer' => $request->trainer ,
            'description' => $request->description ,
            'date' => $request->date ,
            'hour' => $request->hour ,
            'script' => $request->script,
            'type' => $request->type,
            'code' => $request->code,
        ]);

        if(!is_null($onlineClass)  && $request->file('image')){
            $onlineClass->clearMediaCollection('onlineClass');
            $onlineClass->addMediaFromRequest('image')->toMediaCollection('onlineClass');
        }

        if(!is_null($onlineClass)  && $request->file('tokens')){
            $onlineClass->clearMediaCollection('tokens');
            $onlineClass->addMediaFromRequest('tokens')->toMediaCollection('tokens');
        }

        return redirect()->route('admin.onlineClass.index');
    }

    public function adminTrash(){
        $onlineClasses = OnlineClass::onlyTrashed()->orderBy('created_at', 'ASC')->get();
        return view('admin.onlineclass.trash', [
            'onlineClasses' => $onlineClasses,
        ]);
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        OnlineClass::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminRestore($slug){
        OnlineClass::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $onlineClass = OnlineClass::onlyTrashed()->where('slug', $request->slug)->first();
        $onlineClass->clearMediaCollection('onlineClass');
        $onlineClass->forceDelete();
        return redirect()->back();
    }

    public function test(){
        $users = User::whereHas('subscription', function($query){
            $query->where('state', 1);
        })->where('token', '!=', null)->get();
        $onlineClass = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->whereTime('hour', '>=', Carbon::now()->format('H:i:s'))->where('type', 'onlineclass')->orderBy('date', 'ASC')->first();
        $onWeekBefore = Carbon::parse($onlineClass->date)->subWeek()->format('Y-m-d');
        $oneDayBefore = Carbon::parse($onlineClass->date)->subDay()->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        if(($onWeekBefore == Carbon::now()->format('Y-m-d')  and Carbon::parse($onlineClass->hour)->format('H:i') >= '08:00') or ($oneDayBefore == Carbon::now()->format('Y-m-d') and Carbon::parse($onlineClass->hour)->format('H:i') >= '08:00') or ($today == Carbon::now()->format('Y-m-d') and Carbon::parse($onlineClass->hour)->format('H:i') >= '18:00')){
            for ($i=0; $i < count($users) ; $i++) {
                $data = [
                    'first_name' => $users[$i]->first_name,
                    'trainer' => $onlineClass->Trainer->first_name.' '.$onlineClass->Trainer->last_name,
                    'token' => $users[$i]->token,
                    'date' => Carbon::parse($onlineClass->date)->translatedFormat('d F Y'),
                    'hour' => $onlineClass->hour,
                    'onlineClass' => $onlineClass->title,
                    'image' => $onlineClass->getFirstMediaUrl('onlineClass'),
                    'link' => route('onlineClass.open', $onlineClass->slug),
                ];
                Mail::to($users[$i]->email)->send(new DispatchTokenEmail($data));
            }
        }
    }

    public function redirectionCRM(){
        return Redirect::to('https://crm.etudes.ci/onlineclassroom');
    }
}
