<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use App\Models\Articles;
use App\Models\Domaines;
use Illuminate\Http\Request;
use App\Models\Certifications;
use App\Models\Accreditassions;
use Cviebrock\EloquentSluggable\Services\SlugService;

class OfficeController extends Controller
{
    //
    public function adminIndex(){
        $offices = Offices::orderBy('created_at', 'ASC')->get();
        return view('admin.offices.index', [
            'offices' => $offices,
        ]);
    }

    public function adminCreate(){
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'cabinet');
        })->get();
        $accreditassions = Accreditassions::orderBy('acronym', 'ASC')->get();
        return view('admin.offices.create', [
            'domaines' => $domaines,
            'accreditassions' => $accreditassions,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:offices,email',
            'phone' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'domaines' => 'required|array',
            'accreditassions' => 'required|array',
        ]);

        $office = Offices::create([
            'name' => $request->name,
            'slug' => SlugService::createSlug(Offices::class, 'slug', $request->name),
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'description' => $request->description,
        ]);

        if(!is_null($office)){
            $office->Domaines()->attach($request->domaines);
            $office->Accreditassions()->attach($request->accreditassions);
            $office->addMediaFromRequest('image')->toMediaCollection('offices');
        }
        return redirect()->route('admin.office.index');
    }

    public function adminEdit($slug){
        $office = Offices::where('slug', $slug)->first();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'cabinet');
        })->get();
        $accreditassions = Accreditassions::orderBy('acronym', 'ASC')->get();
        return view('admin.offices.update', [
            'office' => $office,
            'domaines' => $domaines,
            'accreditassions' => $accreditassions,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'slug' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'description' => 'required',
            'domaines' => 'required|array',
            'accreditassions' => 'required|array',
        ]);

        $office = Offices::where('slug', $request->slug)->first();
        $office->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'description' => $request->description,
        ]);

        if(!is_null($office)){
            $office->Domaines()->detach();
            $office->Domaines()->attach($request->domaines);
            $office->Accreditassions()->detach();
            $office->Accreditassions()->attach($request->accreditassions);

            if($request->file('image')){
                $office->clearMediaCollection('offices');
                $office->addMediaFromRequest('image')->toMediaCollection('offices');
            }
        }
        return redirect()->route('admin.office.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        Offices::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $offices = Offices::onlyTrashed()->get();

        return view('admin.offices.trash', [
            'offices' => $offices,
        ]);
    }

    public function adminRestore($slug){
        Offices::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $office = Offices::onlyTrashed()->where('slug', $request->slug)->first();
        $office->clearMediaCollection('offices');
        $office->forceDelete();
        return redirect()->back();
    }






    public function list($subject=null){
        $offices = Offices::paginate(4);
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(5)->get();
        $articles = Articles::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'office');
        })->get();

        if(!is_null($subject)){
            $offices = Offices::where('name', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.offices.list', [
            'offices' => $offices,
            'certifications' => $certifications,
            'articles' => $articles,
            'domaines' => $domaines,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $office = Offices::where('slug', $slug)->first();

        return view('site.offices.details', [
            'office' => $office,
        ]);
    }
}
