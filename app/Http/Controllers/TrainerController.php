<?php

namespace App\Http\Controllers;

use App\Models\Trainers;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TrainerController extends Controller
{
    //
    public function adminIndex(){
        $trainers = Trainers::orderBy('created_at', 'ASC')->get();
        return view('admin.trainers.index', [
            'trainers' => $trainers,
        ]);
    }

    public function adminCreate(){
        return view('admin.trainers.create', [

        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required|unique:trainers,email',
            'contact' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $trainer = Trainers::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'slug' => SlugService::createSlug(Trainers::class, 'slug', $request->first_name),
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'function' => $request->function,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'description' => $request->description,
        ]);

        if(!is_null($trainer)){
            $trainer->addMediaFromRequest('image')->toMediaCollection('trainers');
        }
        return redirect()->route('admin.trainer.index');
    }

    public function adminEdit($slug){
        $trainer = Trainers::where('slug', $slug)->first();
        return view('admin.trainers.update', [
            'trainer' => $trainer,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required',
            'contact' => 'required',
        ]);


        $trainer = Trainers::where('slug', $request->slug)->first();
        $trainer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'address' => $request->address,
            'contact' => $request->contact,
            'function' => $request->function,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'description' => $request->description,
        ]);

        if(!is_null($trainer) && $request->file('image')){
            $trainer->clearMediaCollection('trainers');
            $trainer->addMediaFromRequest('image')->toMediaCollection('trainers');
        }
        return redirect()->route('admin.trainer.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        Trainers::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $trainers = Trainers::onlyTrashed()->get();

        return view('admin.trainers.trash', [
            'trainers' => $trainers,
        ]);
    }

    public function adminRestore($slug){
        Trainers::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $trainer = Trainers::onlyTrashed()->where('slug', $request->slug)->first();
        $trainer->clearMediaCollection('trainers');
        $trainer->forceDelete();
        return redirect()->back();
    }
}
