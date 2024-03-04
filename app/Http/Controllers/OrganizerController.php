<?php

namespace App\Http\Controllers;

use App\Models\Organizers;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OrganizerController extends Controller
{
    //
    public function adminIndex(){
        $organizers = Organizers::orderBy('created_at', 'ASC')->get();
        return view('admin.organizers.index', [
            'organizers' => $organizers,
        ]);
    }

    public function adminCreate(){
        return view('admin.organizers.create', [

        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $organizer = Organizers::create([
            'name' => $request->name,
            'contact' => $request->contact,
            'slug' => SlugService::createSlug(Organizers::class, 'slug', $request->name),
            'description' => $request->description,
        ]);

        if(!is_null($organizer)){
            $organizer->addMediaFromRequest('image')->toMediaCollection('organizers');
        }
        return redirect()->route('admin.organizer.index');
    }

    public function adminEdit($slug){
        $organizer = Organizers::where('slug', $slug)->first();
        return view('admin.organizers.update', [
            'organizer' => $organizer,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'slug' => 'required',
        ]);


        $organizer = Organizers::where('slug', $request->slug)->first();
        $organizer->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'description' => $request->description,
        ]);

        if(!is_null($organizer) && $request->file('image')){
            $organizer->clearMediaCollection('organizers');
            $organizer->addMediaFromRequest('image')->toMediaCollection('organizers');
        }
        return redirect()->route('admin.organizer.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        Organizers::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $organizers = Organizers::onlyTrashed()->get();

        return view('admin.organizers.trash', [
            'organizers' => $organizers,
        ]);
    }

    public function adminRestore($slug){
        Organizers::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $organizer = Organizers::onlyTrashed()->where('slug', $request->slug)->first();
        $organizer->clearMediaCollection('organizers');
        $organizer->forceDelete();
        return redirect()->back();
    }
}
