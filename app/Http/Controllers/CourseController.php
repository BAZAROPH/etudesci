<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Courses;
use App\Models\Modules;
use App\Models\Offices;
use App\Models\Articles;
use App\Models\Domaines;
use App\Models\Trainers;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CourseController extends Controller
{
    //
    public function adminIndex(){
        $courses = Courses::orderBy('created_at', 'ASC')->get();
        return view('admin.courses.index', [
            'courses' => $courses,
        ]);
    }

    public function adminCreate(){
        $trainers = Trainers::orderBy('last_name', 'ASC')->get();
        $offices = Offices::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'cours');
        })->get();
        return view('admin.courses.create', [
            'trainers' => $trainers,
            'offices' => $offices,
            'domaines' => $domaines,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'title' => 'required',
            'office' => 'required',
            'trainer' => 'required',
            'youtube' => 'required',
            'type' => 'required',
            'domaines' => 'required|array',
        ]);

        $course = Courses::create([
            'title' => $request->title,
            'slug' => SlugService::createSlug(Courses::class, 'slug', $request->title),
            'office' => $request->office,
            'trainer' => $request->trainer,
            'youtube' => $request->youtube,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        if(!is_null($course)){
            $course->Domaines()->attach($request->domaines);
            $course->addMediaFromRequest('image')->toMediaCollection('courses');
        }

        return redirect()->route('admin.course.index');
    }

    public function adminEdit($slug){
        $course = Courses::where('slug', $slug)->first();
        $trainers = Trainers::orderBy('last_name', 'ASC')->get();
        $offices = Offices::orderBy('name', 'ASC')->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'cours');
        })->get();
        return view('admin.courses.update', [
            'course' => $course,
            'trainers' => $trainers,
            'offices' => $offices,
            'domaines' => $domaines,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'title' => 'required',
            'office' => 'required',
            'trainer' => 'required',
            'youtube' => 'required',
            'type' => 'required',
            'domaines' => 'required|array',
        ]);

        $course = Courses::where('slug', $request->slug)->first();
        $course->update([
            'title' => $request->title,
            // 'slug' => SlugService::createSlug(Courses::class, 'slug', $request->title),
            'office' => $request->office,
            'trainer' => $request->trainer,
            'youtube' => $request->youtube,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        if(!is_null($course)){
            if(!is_null($request->domaines)){
                $course->Domaines()->detach();
                $course->Domaines()->attach($request->domaines);
            }
            if($request->file('image')){
                $course->clearMediaCollection('courses');
                $course->addMediaFromRequest('image')->toMediaCollection('courses');
            }
        }
        return redirect()->route('admin.course.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        Courses::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $courses = Courses::onlyTrashed()->orderBy('deleted_at', 'ASC')->get();
        return view('admin.courses.trash', [
            'courses' => $courses,
        ]);
    }

    public function adminRestore($slug){
        Courses::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->back();
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $course = Courses::onlyTrashed()->where('slug', $request->slug)->first();
        $course->clearMediaCollection('courses');
        $course->forceDelete();
        return redirect()->back();
    }

    public function adminPublished($slug){
        $course = Courses::where('slug', $slug)->first();
        if($course->published){
            $course->update([
                'published' => 0,
            ]);
        }else{
            $course->update([
                'published' => 1,
            ]);
        }
        return redirect()->back();
    }





    public function list($subject=null){
        $courses = Courses::where('published', 1)->orderBy('created_at', 'ASC')->paginate(4);
        $articles = Articles::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(5)->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'cours');
        })->get();

        if(!is_null($subject)){
            $courses = Courses::where('title', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('trainer', function($query) use ($subject){
                $query->where('first_name', 'LIKE', '%'.$subject.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.courses.list', [
            'courses' => $courses,
            'articles' => $articles,
            'certifications' => $certifications,
            'domaines' => $domaines,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $course = Courses::where('slug', $slug)->first();
        return view('site.courses.details', [
            'course' => $course,
        ]);
    }

    public function taken($slug, $module_slug){
        $course = Courses::where('slug', $slug)->first();
        $user = User::find(Auth::user()->id);
        if (!$user->courses->contains('id', $course->id)){
            $user->Courses()->attach($course->id);
            $user->Modules()->attach($course->Modules);
        }

        return view('site.courses.follow.index', [
            'course' => $course,
        ]);
    }

    public function APIgetCourse(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $course = Courses::where('slug', $request->slug)->first();
        $modules = Modules::whereHas('course', function($query) use($course){
            $query->where('slug', $course->slug);
        })->with('users', function($query){
            $query->where('users.id', Auth::user()->id)->select('state');
        })->get();
        for ($i=0; $i < count($modules); $i++) {
            $modules[$i]->document = $modules[$i]->getfirstMediaUrl('documents');
        }

        $office = $course->Office;
        $office->img = $office->getFirstMediaUrl('offices');

        return response()->json([
            'course' => $course,
            'modules' => $modules,
            'courseDomaines' => $course->Domaines,
            'office' => $office,
        ]);
    }

    public function APIgetModule(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $module = Modules::where('slug', $request->slug)->first();
        $module->document = $module->getfirstMediaUrl('documents');

        return response()->json([
            'module' => $module,
        ]);
    }

    public function APIupdateModuleStateFinish(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $module = Modules::where('slug', $request->slug)->first();
        $module->Users()->updateExistingPivot(Auth::user(), ['state' => 1], false);
        return response()->json([
            'sucess' => true,
        ]);

    }


    public function APIupdateModuleStateUnFinish(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        $module = Modules::where('slug', $request->slug)->first();
        $module->Users()->updateExistingPivot(Auth::user(), ['state' => null], false);
        return response()->json([
            'sucess' => true,
        ]);

    }
}
