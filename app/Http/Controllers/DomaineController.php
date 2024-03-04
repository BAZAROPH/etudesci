<?php

namespace App\Http\Controllers;

use App\Models\Domaines;
use App\Models\DomaineTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DomaineController extends Controller
{
    //
    public function adminDomaineTypeIndex(){
        $types = DomaineTypes::orderBy('created_at', 'DESC')->get();
        foreach ($types as $value) {
            $value->date = Carbon::parse($value->created_at)->format('d-m-Y');
        }
        return view('admin.domaines.type.index', [
            'types' => $types,
        ]);
    }

    public function adminDomaineTypeStore(Request $request){
        $request->validate([
            'label' => 'required|unique:domaine_types,label',
        ]);
        DomaineTypes::create([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminDomaineTypeUpdate(Request $request){
        $request->validate([
            'label' => 'required',
            'id' => 'required|numeric',
        ]);

        DomaineTypes::find($request->id)->update([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminDomaineTypeDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        DomaineTypes::find($request->id)->forceDelete();
        return redirect()->back();
    }





    public function adminIndex(){
        $domaines =  Domaines::orderBy('label', 'ASC')->get();
        $types = DomaineTypes::all();
        return view('admin.domaines.index', [
            'domaines' => $domaines,
            'types' => $types,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'label' => 'required',
            'type' => 'required'
        ]);

        Domaines::create([
            'label' => $request->label,
            'type' => $request->type,
        ]);

        return redirect()->route("admin.domaine.index");

    }

    public function adminUpdate(Request $request){
        $request->validate([
            'label' => 'required',
            'type' => 'required',
            'id' => 'required|numeric',
        ]);

        $domaine = Domaines::find($request->id);
        $domaine->update([
            'label' => $request->label,
            'type' => $request->type,
        ]);
        return redirect()->back();
    }

    public function adminDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        Domaines::find($request->id)->delete();

        return redirect()->back();
    }

    public function adminTrash(){
        $domaines =  Domaines::orderBy('label', 'ASC')->onlyTrashed()->get();
        return view('admin.domaines.trash', [
            'domaines' => $domaines,
        ]);
    }

    public function adminRestore($id){
        Domaines::where('id', $id)->onlyTrashed()->restore();
        return redirect()->route('admin.domaine.index');
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        Domaines::onlyTrashed()->where('id', $request->id)->forceDelete();
        return redirect()->back();
    }
}
