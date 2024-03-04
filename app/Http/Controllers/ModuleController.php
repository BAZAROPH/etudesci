<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Modules;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ModuleController extends Controller
{
    //
    public function adminIndex($course_slug){
        $course = Courses::where('slug', $course_slug)->first();
        $modules = Modules::where('course', $course->id)->get();
        return view('admin.courses.modules.index', [
            'course_slug' => $course_slug,
            'course' => $course,
            'modules' => $modules,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            // 'image' => 'required',
            // 'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'title' => 'required',
            'slug' => SlugService::createSlug(Modules::class, 'slug', $request->title),
            'youtube' => 'required|url',
            'duration' => 'required|numeric',
            'course_slug' => 'required',
        ]);

        $course = Courses::where('slug', $request->course_slug)->first();
        $module = Modules::create([
            'title' => $request->title,
            'youtube' => $request->youtube,
            'duration' => $request->duration,
            'description' => $request->description,
            'course' => $course->id,
        ]);

        if(!is_null($module)){
            // $module->addMediaFromRequest('image')->toMediaCollection('modules');
            if($request->file('documents')){
                $module->addMultipleMediaFromRequest(['documents'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('documents');
                });
            }
        }
        return redirect()->back();
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'youtube' => 'required|url',
            'duration' => 'required|numeric',
            'course_slug' => 'required',
            'id' => 'required',
        ]);


        $module = Modules::find($request->id);
        $module->update([
            'title' => $request->title,
            'youtube' => $request->youtube,
            'duration' => $request->duration,
            'description' => $request->description,
        ]);

        if(!is_null($module)){
            if($request->file('image')){
                $module->clearMediaCollection('image');
                $module->addMediaFromRequest('image')->toMediaCollection('modules');
            }
            if($request->file('documents')){
                $module->clearMediaCollection('documents');
                $module->addMultipleMediaFromRequest(['documents'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('documents');
                });
            }
        }

        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        Modules::find($request->id)->forceDelete();

        return redirect()->back();
    }

}
