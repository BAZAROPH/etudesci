<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    //
    public function index(){
        return view('site.resumes.index');
    }

    public function workSpace($model){
        return view('site.resumes.workSpace');
    }

    public function create(Request $request){
        $request->validate([
            'name' => 'required|string',
            'data' => 'required|json',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);
        $resume = Resume::where('user', Auth::user()->id)->first();
        if(is_null($resume)){
            $resume = Resume::create([
                'data' => $request->data,
                'name' => $request->name,
                'user' => Auth::user()->id,
            ]);
            if($request->file('image')){
                $resume->addMediaFromRequest('image')->toMediaCollection('resumes');
            }
        }else{
            $resume->update([
                'data' => $request->data,
                'name' => $request->name,
            ]);
            if($request->file('image')){
            $resume->clearMediaCollection('resumes');
            $resume->addMediaFromRequest('image')->toMediaCollection('resumes');
            }
        }

        return response()->json([
            'success'=> true,
        ]);
    }

    public function get(){
        $resume = Resume::where('user', Auth::user()->id)->first();
        $resume->image = $resume->getFirstMediaUrl('resumes');

        return response()->json([
            'resume' => $resume,
        ]);
    }

    public function share($email){
        $user = User::where('email', $email)->first();
        $resume = Resume::where('user', $user->id)->first();
        $resume->data = json_decode($resume->data, true);
        return view('site.resumes.share', [
            'resume'=> $resume,
        ]);
    }
}
