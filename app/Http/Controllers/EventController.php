<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Articles;
use App\Models\Domaines;
use App\Models\EventTypes;
use App\Models\Organizers;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Illuminate\Support\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;

class EventController extends Controller
{
    //
     //
     public function adminEventTypeIndex(){
        $types = EventTypes::orderBy('created_at', 'DESC')->get();
        foreach ($types as $value) {
            $value->date = Carbon::parse($value->created_at)->format('d-m-Y');
        }
        return view('admin.events.type.index', [
            'types' => $types,
        ]);
    }

    public function adminEventTypeStore(Request $request){
        $request->validate([
            'label' => 'required|unique:event_types,label',
        ]);
        EventTypes::create([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminEventTypeUpdate(Request $request){
        $request->validate([
            'label' => 'required',
            'id' => 'required|numeric',
        ]);

        EventTypes::find($request->id)->update([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminEventTypeDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        EventTypes::find($request->id)->forceDelete();
        return redirect()->back();
    }


    public function adminIndex(){
        $events = Events::orderBy('created_at', 'ASC')->get();
        return view('admin.events.index', [
            'events' => $events,
        ]);
    }

    public function adminCreate(){
        $types = EventTypes::orderBy('label', 'ASC')->get();
        $organizers = Organizers::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'évènement');
        })->get();
        return view('admin.events.create', [
            'types' => $types,
            'organizers' => $organizers,
            'domaines' => $domaines,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'name' => 'required',
            'organizer' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'place_type' => 'required',
            'place' => 'required',
            'phone' => 'required',
            'place_type' => 'required',
            'domaines' => 'required|array',
        ]);

        $event = Events::create([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Events::class, 'slug', $request->name),
            'organizer' => $request->organizer,
            'type' => $request->type,
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'email' => $request->email,
            'place_type' => $request->place_type,
            'place' => $request->place,
            'personalized_link' => $request->personalized_link,
            'registration_link' => $request->registration_link,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'published' => 0,
            'description' => $request->description,
        ]);

        if(!is_null($event)){
            $event->Domaines()->attach($request->domaines);
            $event->addMediaFromRequest('image')->toMediaCollection('events');
        }
        return redirect()->route('admin.event.index');
    }

    public function adminEdit($slug){
        $event = Events::where('slug', $slug)->first();
        $types = EventTypes::orderBy('label', 'ASC')->get();
        $organizers = Organizers::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'évènement');
        })->get();
        return view('admin.events.update', [
            'event' => $event,
            'types' => $types,
            'organizers' => $organizers,
            'domaines' => $domaines,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'slug' => 'required',
            'name' => 'required',
            'organizer' => 'required',
            'type' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'place_type' => 'required',
            'place' => 'required',
            'phone' => 'required',
            'place_type' => 'required',
            'domaines' => 'required|array',
        ]);

        $event = Events::where('slug', $request->slug)->first();
        // dd($event, $request->all());
        $event->update([
            'name' => $request->name,
            // 'slug' => SlugService::createSlug(Events::class, 'slug', $request->name),
            'organizer' => $request->organizer,
            'type' => $request->type,
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'email' => $request->email,
            'place_type' => $request->place_type,
            'place' => $request->place,
            'personalized_link' => $request->personalized_link,
            'registration_link' => $request->registration_link,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'description' => $request->description,
        ]);

        if(!is_null($event)){
            $event->Domaines()->detach();
            $event->Domaines()->attach($request->domaines);
            if($request->file('image')){
                $event->clearMediaCollection('events');
                $event->addMediaFromRequest('image')->toMediaCollection('events');
            }
        }

        return redirect()->route('admin.event.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        Events::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $events = Events::onlyTrashed()->orderBy('created_at', 'ASC')->get();
        return view('admin.events.trash', [
            'events' => $events,
        ]);
    }

    public function adminRestore($slug){
        Events::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $event = Events::onlyTrashed()->where('slug', $request->slug)->first();
        $event->clearMediaCollection('events');
        $event->forceDelete();
        return redirect()->back();
    }

    public function adminPublished($slug){
        $event = Events::where('slug', $slug)->first();
        if($event->published){
            $event->update([
                'published' => 0,
            ]);
        }else{
            $event->update([
                'published' => 1,
            ]);
        }
        return redirect()->back();
    }







    public function list($subject=null){
        $events = Events::where('start_date', '>=', Carbon::now())->where('published', 1)->paginate(4);
        $articles = Articles::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(5)->get();
        $types = EventTypes::orderBy('label', 'ASC')->get();

        if(!is_null($subject)){
            $events = Events::where('name', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('organizer', function($query) use ($subject){
                $query->where('name', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('type', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.events.list', [
            'events' => $events,
            'articles' => $articles,
            'certifications' => $certifications,
            'types' => $types,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $event = Events::where('slug', $slug)->first();
        return view('site.events.details', [
            'event' => $event,
        ]);
    }

}
