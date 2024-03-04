<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Authors;
use App\Models\Courses;
use App\Models\Articles;
use App\Models\Domaines;
use App\Models\AuthorTypes;
use App\Models\ArticleTypes;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Illuminate\Support\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ArticleController extends Controller
{
    //
    public function adminArticleTypeIndex(){
        $types = ArticleTypes::orderBy('created_at', 'DESC')->get();
        foreach ($types as $value) {
            $value->date = Carbon::parse($value->created_at)->format('d-m-Y');
        }
        return view('admin.articles.type.index', [
            'types' => $types,
        ]);
    }

    public function adminArticleTypeStore(Request $request){
        $request->validate([
            'label' => 'required|unique:author_types,label',
        ]);
        ArticleTypes::create([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminArticleTypeUpdate(Request $request){
        $request->validate([
            'label' => 'required',
            'id' => 'required|numeric',
        ]);

        ArticleTypes::find($request->id)->update([
            'label' => $request->label,
        ]);
        return redirect()->back();
    }

    public function adminArticleTypeDelete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        ArticleTypes::find($request->id)->forceDelete();
        return redirect()->route('admin.article.index');
    }



    public function adminIndex(){
        $articles = Articles::orderBy('created_at', 'DESC')->get();
        return view('admin.articles.index', [
            'articles' => $articles,
        ]);
    }

    public function adminCreate(){
        $authors = Authors::whereHas('type', function($query){
            $query->where('label', 'article');
        })->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'article');
        })->get();
        $types = ArticleTypes::orderBy('label', 'DESC')->get();
        return view('admin.articles.create', [
            'authors' => $authors,
            'types' => $types,
            'domaines' => $domaines,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required',
            'authors' => 'required|array',
            'domaines' => 'required|array',
            'text' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $article = Articles::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => SlugService::createSlug(Articles::class, 'slug', $request->title),
            'type' => $request->type,
            'text' => $request->text,
            'published' => 0,
        ]);

        if(!is_null($article)){
            $article->Authors()->attach($request->authors);
            $article->Domaines()->attach($request->domaines);
            $article->addMediaFromRequest('image')->toMediaCollection('articles');
        }

        return redirect()->route('admin.article.index');
    }

    public function adminEdit($slug){
        $article = Articles::where('slug', $slug)->first();
        $authors = Authors::whereHas('type', function($query){
            $query->where('label', 'article');
        })->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'article');
        })->get();
        $types = ArticleTypes::orderBy('label', 'DESC')->get();

        return view('admin.articles.update', [
            'article' => $article,
            'authors' => $authors,
            'types' => $types,
            'domaines' => $domaines,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'type' => 'required',
            'authors' => 'required|array',
            'text' => 'required',
            'slug' => 'required',
            'domaines' => 'required|array',
        ]);

        $article = Articles::where('slug', $request->slug)->first();
        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            // 'slug' => SlugService::createSlug(Articles::class, 'slug', $request->title),
            'type' => $request->type,
            'text' => $request->text,
        ]);

        if(!is_null($article)){
            $article->Authors()->detach();
            $article->Authors()->attach($request->authors);
            $article->Domaines()->detach();
            $article->Domaines()->attach($request->domaines);
            if($request->file('image')){
                $article->clearMediaCollection('articles');
                $article->addMediaFromRequest('image')->toMediaCollection('articles');
            }
        }

        return redirect()->route('admin.article.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        Articles::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $articles = Articles::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('admin.articles.trash', [
            'articles' => $articles,
        ]);
    }

    public function adminRestore($slug){
        Articles::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->route('admin.article.index');
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $article = Articles::onlyTrashed()->where('slug', $request->slug)->first();
        $article->clearMediaCollection('articles');
        $article->Authors()->detach();
        $article->forceDelete();
        return redirect()->route("admin.article.index");
    }

    public function adminPublished($slug){
        $article = Articles::where('slug', $slug)->first();
        if($article->published){
            $article->update([
                'published' => 0,
            ]);
        }else{
            $article->update([
                'published' => 1,
            ]);
        }
        return redirect()->back();
    }

    public function adminLeftSlide($slug){
        $article = Articles::where('slug', $slug)->first();
        if($article->vertical_slide){
            $article->update([
                'vertical_slide' => 0,
            ]);
        }else{
            $article->update([
                'vertical_slide' => 1,
            ]);
        }
        return redirect()->back();
    }

    public function adminRightSlide($slug){
        $article = Articles::where('slug', $slug)->first();
        if($article->horizontal_slide){
            $article->update([
                'horizontal_slide' => 0,
            ]);
        }else{
            $article->update([
                'horizontal_slide' => 1,
            ]);
        }
        return redirect()->back();
    }






    public function list($subject=null){
        $articles = Articles::where('published', 1)->orderBy('created_at', 'DESC')->paginate(4);
        $events = Events::where('start_date', '>=', Carbon::now())->where('published', 1)->orderBy('created_at', 'ASC')->limit(4)->get();
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(4)->get();
        $types = ArticleTypes::orderBy('label', 'ASC')->get();

        if(!is_null($subject)){
            $articles = Articles::where('title', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('authors', function($query) use ($subject){
                $query->where('first_name', 'LIKE', '%'.$subject.'%')
                ->orWhere('last_name', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('type', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.articles.list', [
            'articles' => $articles,
            'events' => $events,
            'certifications' => $certifications,
            'types' => $types,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $article = Articles::where('slug', $slug)->first();
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(4)->get();
        $courses = Courses::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        return view('site.articles.details', [
            'article' => $article,
            'certifications' => $certifications,
            'courses' => $courses,
        ]);
    }
}
