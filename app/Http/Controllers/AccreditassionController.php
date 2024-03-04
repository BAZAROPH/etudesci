<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accreditassions;

class AccreditassionController extends Controller
{
    //
    public function adminIndex(){
        $accreditassions = Accreditassions::orderBy('label', 'ASC')->get();

        return view('admin.accreditassions.index', [
            'accreditassions' => $accreditassions
        ]);
    }

    public function adminCreate(){
        return view('admin.accreditassions.create');
    }

    public function adminStore(Request $request){
        $request->validate([
            'acronym' => 'required',
            'label' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $accreditassion = Accreditassions::create([
            'acronym' => $request->acronym,
            'label' => $request->label,
        ]);

        if(!is_null($accreditassion)){
            $accreditassion->addMediaFromRequest('image')->toMediaCollection('accreditassions');
        }

        return redirect()->route('admin.accreditassion.index');
    }

    public function adminEdit($id){
        $accreditassion = Accreditassions::find($id);
        return view('admin.accreditassions.update', [
            'accreditassion' => $accreditassion,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'acronym' => 'required',
            'label' => 'required',
            'id' => 'required',
        ]);

        $accreditassion = Accreditassions::find($request->id);
        $accreditassion->update([
            'acronym' => $request->acronym,
            'label' => $request->label,
        ]);

        if(!is_null($accreditassion) && $request->file('image')){
            $accreditassion->clearMediaCollection('accreditassions');
            $accreditassion->addMediaFromRequest('image')->toMediaCollection('accreditassions');
        }

        return redirect()->route('admin.accreditassion.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        Accreditassions::find($request->id)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $accreditassions = Accreditassions::onlyTrashed()->orderBy('label', 'ASC')->get();

        return view('admin.accreditassions.trash', [
            'accreditassions' => $accreditassions
        ]);
    }

    public function adminRestore($id){
        $accreditassion = Accreditassions::onlyTrashed()->find($id);
        $accreditassion->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $accreditassion = Accreditassions::onlyTrashed()->find($request->id);
        $accreditassion->clearMediaCollection('accreditassion');
        $accreditassion->forceDelete();
        return redirect()->back();
    }

}
