<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Authors;
use App\Models\Articles;
use App\Models\Domaines;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BookController extends Controller
{
    //
    public function adminIndex(){
        $books = Books::orderBy('created_at', 'DESC')->get();
        return view('admin.books.index', [
            'books' => $books,
        ]);
    }

    public function adminCreate(){
        $authors = Authors::whereHas('type', function($query){
            $query->where('label', 'livre');
        })->get();

        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'livre');
        })->get();

        return view('admin.books.create', [
            'authors' => $authors,
            'domaines' => $domaines,
        ]);
    }

    public function adminStore(Request $request){
        $request->validate([
            'title' => 'required',
            'authors' => 'required|array',
            'price' => 'required',
            'script' => 'required',
            'description' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpg,png,jpeg,webp|max:2048',
            'domaines' => 'required|array',
        ]);

        $book = Books::create([
            'title' => $request->title,
            'slug' => SlugService::createSlug(Books::class, 'slug', $request->title),
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'script' => $request->script,
            'description' => $request->description,
        ]);
        if(!is_null($book)){
            $book->Authors()->attach($request->authors);
            $book->Domaines()->attach($request->domaines);
            $book->addMediaFromRequest('image')->toMediaCollection('books');
        }
        return redirect()->route('admin.book.index');
    }

    public function adminEdit($slug){
        $authors = Authors::whereHas('type', function($query){
            $query->where('label', 'livre');
        })->get();

        $book = Books::where('slug', $slug)->first();

        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'livre');
        })->get();

        return view('admin.books.update', [
            'book' => $book,
            'authors' => $authors,
            'domaines' => $domaines,
        ]);
    }

    public function adminUpdate(Request $request){
        $request->validate([
            'slug' => 'required',
            'title' => 'required',
            'authors' => 'required|array',
            'price' => 'required',
            'script' => 'required',
            'description' => 'required',
            'domaines' => 'required|array',
        ]);

        $book = Books::where('slug', $request->slug)->first();
        $book->update([
            'title' => $request->title,
            // 'slug' => SlugService::createSlug(Books::class, 'slug', $request->title),
            'price' => $request->price,
            'reduction' => $request->reduction,
            'premium_price' => $request->premium_price,
            'script' => $request->script,
            'description' => $request->description,
        ]);

        if(!is_null($book)){
            $book->Authors()->detach();
            $book->Authors()->attach($request->authors);
            $book->Domaines()->detach();
            $book->Domaines()->attach($request->domaines);
            if($request->file('image')){
                $book->clearMediaCollection('books');
                $book->addMediaFromRequest('image')->toMediaCollection('books');
            }
        }
        return redirect()->route('admin.book.index');
    }

    public function adminDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);

        Books::where('slug', $request->slug)->delete();
        return redirect()->back();
    }

    public function adminTrash(){
        $books = Books::onlyTrashed()->orderBy('created_at', 'DESC')->get();
        return view('admin.books.trash', [
            'books' => $books,
        ]);
    }

    public function adminRestore($slug){
        Books::onlyTrashed()->where('slug', $slug)->restore();
        return redirect()->route('admin.book.index');
    }

    public function adminForceDelete(Request $request){
        $request->validate([
            'slug' => 'required',
        ]);
        $book = Books::onlyTrashed()->where('slug', $request->slug)->first();
        $book->clearMediaCollection('books');
        $book->Authors()->detach();
        $book->forceDelete();
        return redirect()->back();
    }

    public function adminPublished($slug){
        $book = Books::where('slug', $slug)->first();
        if($book->published){
            $book->update([
                'published' => 0,
            ]);
        }else{
            $book->update([
                'published' => 1,
            ]);
        }
        return redirect()->back();
    }






    public function list($subject=null){
        $books = Books::where('published', 1)->paginate(4);
        $articles = Articles::where('published', 1)->orderBy('created_at', 'ASC')->limit(5)->get();
        $certifications = Certifications::orderBy('start_date', 'ASC')->limit(5)->get();
        $domaines = Domaines::whereHas('type', function($query){
            $query->where('label', 'livre');
        })->get();

        if(!is_null($subject)){
            $books = Books::where('title', 'LIKE', '%'.$subject.'%')
            ->orWhereHas('authors', function($query) use ($subject){
                $query->where('first_name', 'LIKE', '%'.$subject.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$subject.'%');
            })
            ->orWhereHas('domaines', function($query) use ($subject){
                $query->where('label', 'LIKE', '%'.$subject.'%');
            })
            ->paginate(100);
        }

        return view('site.books.list', [
            'books' => $books,
            'articles' => $articles,
            'certifications' => $certifications,
            'domaines' => $domaines,
            'subject' => $subject,
        ]);
    }

    public function details($slug){
        $book = Books::where('slug', $slug)->first();
        return view('site.books.details', [
            'book' => $book,
        ]);
    }

}
