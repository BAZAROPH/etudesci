<?php

namespace App\Http\Controllers;

use App\Models\Offices;
use App\Models\Articles;
use App\Models\Books;
use App\Models\Domaines;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CertificationController extends Controller
{
    //
    public function adminIndex(){
        $certifications = Certifications::orderBy('created_at', 'ASC')->get();
        return view('admin.certifications.index', [
            'certifications' => $certifications,
        ]);
    }

    public function adminCreate(){
        $offices = Offices::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'certification');
        })->get();
        return view('admin.certifications.create', [
            'offices' => $offices,
            'domaines' => $domaines,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'office' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location_type' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'domaines' => 'required|array',
        ]);

        $certification = Certifications::create([
            'title' => $request->title,
            'slug' => SlugService::createSlug(Certifications::class, 'slug', $request->title),
            'office' => $request->office,
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'office_money' => $request->office_money,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location_type' => $request->location_type,
            'email' => $request->email,
            'website' => $request->website,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'description' => $request->description,
            'objective' => $request->objective,
            'script' => $request->script,
            'personalized_script' => $request->personalized_script,
        ]);

        if(!is_null($certification)){
            $certification->Domaines()->attach($request->domaines);
            $certification->addMediaFromRequest('image')->toMediaCollection('certifications');
        }

        return redirect()->route('admin.certification.index');
    }

    public function adminEdit($slug){
        $certification = Certifications::where('slug', $slug)->first();
        $offices = Offices::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'certification');
        })->get();
        return view('admin.certifications.update', [
            'certification' => $certification,
            'offices' => $offices,
            'domaines' => $domaines,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'office' => 'required',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location_type' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'domaines' => 'required|array',
        ]);


        $certification = Certifications::where('slug', $request->slug)->first();
        $certification->update([
            'title' => $request->title,
            // 'slug' => SlugService::createSlug(Certifications::class, 'slug', $request->title),
            'office' => $request->office,
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'office_money' => $request->office_money,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location_type' => $request->location_type,
            'email' => $request->email,
            'website' => $request->website,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'description' => $request->description,
            'objective' => $request->objective,
            'script' => $request->script,
            'personalized_script' => $request->personalized_script,
        ]);

        if(!is_null($certification) && $request->file('image')){
            $certification->Domaines()->detach();
            $certification->Domaines()->attach($request->domaines);
            $certification->clearMediaCollection('certifications');
            $certification->addMediaFromRequest('image')->toMediaCollection('certifications');
        }
        return redirect()->route('admin.certification.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        Certifications::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $certifications = Certifications::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('admin.certifications.trash', [
            'certifications' => $certifications,
        ]);
    }

    public function adminRestore($slug){
        Certifications::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $certification = Certifications::onlyTrashed()->where('slug', $request->slug)->first();
        $certification->clearMediaCollection('certifications');
        $certification->forceDelete();
        return redirect()->back();
    }







    public function list($subject=null){
        $certifications = Certifications::orderBy('start_date', 'ASC')->whereDate('start_date', '>=', Carbon::now())->paginate(4);
        $articles = Articles::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        $books = Books::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();

        if(!is_null($subject)){
            $certifications = Certifications::where('title', 'LIKE', '%'.$subject.'%')
            ->orWhere('location_type', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('office', function($query) use ($subject){
                $query->where('name', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.certifications.list', [
            'certifications' => $certifications,
            'articles' => $articles,
            'books' => $books,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $certification = Certifications::where('slug', $slug)->first();
        return view('site.certifications.details', [
            'certification' => $certification,
        ]);
    }
}
