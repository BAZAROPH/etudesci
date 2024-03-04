<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Authors;
use App\Models\AuthorTypes;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AuthorController extends Controller
{
    //
    public function adminAuthorTypeIndex(){
        $types = AuthorTypes::orderBy('created_at', 'DESC')->get();
        foreach ($types as $value) {
            $value->date = Carbon::parse($value->created_at)->format('d-m-Y');
        }
        return view('admin.authors.type.index', [
            'types' => $types,
        ]);
    }

    public function adminAuthorTypeStore(Request $request){
        $request->validate([
            'label' => 'required|unique:author_types,label',
        ]);
        AuthorTypes::create([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminAuthorTypeUpdate(Request $request){
        $request->validate([
            'label' => 'required',
            'id' => 'required|numeric',
        ]);

        AuthorTypes::find($request->id)->update([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminAuthorTypeDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        AuthorTypes::find($request->id)->forceDelete();
        return redirect()->back();
    }



    public function adminCreate(){
        $types = AuthorTypes::orderBy('label', 'ASC')->get();
        return view('admin.authors.create', [
            'types' => $types,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'type' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $author = Authors::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'slug' => SlugService::createSlug(Authors::class, 'slug', $request->first_name),
            'company' => $request->company,
            'function' => $request->function,
            'type' => $request->type,
        ]);
        if(!is_null($author)){
            $author->addMediaFromRequest('image')->toMediaCollection('authors');
        }
        return redirect()->route("admin.author.index");
    }

    public function adminIndex(){
        $authors = Authors::orderBy('created_at', 'DESC')->get();
        return view('admin.authors.index', [
            'authors' => $authors,
        ]);
    }

    public function adminEdit($slug){
        $author  = Authors::where('slug', $slug)->first();
        $types = AuthorTypes::orderBy('label', 'ASC')->get();

        return view('admin.authors.update', [
            'author' => $author,
            'types' => $types,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'type' => 'required|max:255',
            'slug' => 'required',
        ]);

        $author = Authors::where('slug', $request->slug)->first();
        $author->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'company' => $request->company,
            'function' => $request->function,
            'type' => $request->type,
        ]);
        if(!is_null($author) && $request->file('image')){
            $author->clearMediaCollection('authors');
            $author->addMediaFromRequest('image')->toMediaCollection('authors');
        }
        return redirect()->route('admin.author.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        Authors::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $authors = Authors::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('admin.authors.trash', [
            'authors' => $authors,
        ]);
    }

    public function adminRestore($slug){
        Authors::where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $author = Authors::onlyTrashed()->where('slug', $request->slug)->first();
        $author->clearMediaCollection('authors');
        $author->forceDelete();
        return redirect()->back();
    }
}
