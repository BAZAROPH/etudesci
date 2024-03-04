<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Tests;
// use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Courses;
use App\Models\Questions;
use App\Models\OnlineClass;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    //
    public function index($slug){
        $questions = Questions::whereHas('course', function($query) use($slug){
            $query->where('slug', $slug);
        })->get();
        $course = Courses::where('slug', $slug)->first();
        return view('admin.onlineclass.questions.index', [
            'questions' => $questions,
            'course' => $course,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'course' => 'required',
            'question' => 'required',
            'response_1' => 'required',
            'response_2' => 'required',
            'response_3' => 'required',
            'response' => 'required',
        ]);
        Questions::create([
            'course' => $request->course,
            'question' => $request->question,
            'response_1' => $request->response_1,
            'response_2' => $request->response_2,
            'response_3' => $request->response_3,
            'response' => $request->response,
        ]);
        return redirect()->back();
    }

    public function update(Request $request){
        $request->validate([
            'id' => 'required|numeric',
            'question' => 'required',
            'response_1' => 'required',
            'response_2' => 'required',
            'response_3' => 'required',
            'response' => 'required',
        ]);

        $question  = Questions::find($request->id);
        $question->update([
            'question' => $request->question,
            'response_1' => $request->response_1,
            'response_2' => $request->response_2,
            'response_3' => $request->response_3,
            'response' => $request->response,
        ]);

        return redirect()->back();
    }

    public function delete(Request $request){
        $request->validate([
            'id' => 'required|numeric',
        ]);

        Questions::find($request->id)->delete();
        return redirect()->back();
    }

    public function test($slug){
        $course = Courses::where('slug', $slug)->first();
        $questions = Questions::whereHas('course', function($query) use($slug){
            $query->where('slug', $slug);
        })->get();
        $test = Tests::where('course', $course->id)->where('user', Auth::user()->id)->first();
        $score = null;
        $until = null;
        $blocked = false;
        $success = false;
        if(!is_null($test)){
            if ($test->score >= 60) {
                $success = true;
            }else {
                $score = $test->score;
                // $countdown = Carbon::parse($test->passed_at)->diffInHours(Carbon::now());
                $blocked = Carbon::now() < Carbon::parse($test->passed_at)->addHour() and $test->score < 60;
                $until = Carbon::parse($test->passed_at)->addHour()->format('H\h:i');
            }
        }
        return view('site.courses.quiz.test', [
            'course' => $course,
            'questions' => $questions,
            'test' => $test,
            'score' => $score,
            'blocked' => $blocked,
            'until' => $until,
            'success' => $success,
        ]);
    }

    public function save(Request $request){
        $questions = Questions::whereHas('course', function($query) use($request){
            $query->where('slug', $request->course_slug);
        })->get();
        $course = Courses::where('slug', $request->course_slug)->first();

        $score = 0;

        foreach ($questions as $key => $question) {
            if(!is_null($request->input('choice_'.($key+1))) and $question->response == $request->input('choice_'.($key+1))){
                $score++;
            }
        }
        $score = ($score*100)/count($questions);
        $test = Tests::where('course', $course->id)->where('user', Auth::user()->id)->first();
        if(!is_null($test)){
            $test->update([
                'score' => $score,
                'passed_at' => Carbon::now(),
            ]);
        }else{
            $test = Tests::create([
                'score' => $score,
                'course' => $course->id,
                'user' => Auth::user()->id,
                'passed_at' => Carbon::now(),
            ]);
        }

        if($score < 60){
            return redirect()->back()->withErrors([
                'message' => 'Désolé, vous avez eu moins de 60% des réponses correctes. Veuillez réessayer dans 1h',
                'score' => $score
            ]);
        }else{
            return redirect()->back();
        }
    }

    public function downloadCertificate($slug, $test_id){
        // return view('site.courses.quiz.certificate');
        // Chemin vers l'image à convertir
        $course = Courses::where('slug', $slug)->first();
        $imagePath = public_path('site/assets/subscriptions/certificate.jpg');

        // Convertir l'image en base64
        $base64Image = base64_encode(file_get_contents($imagePath));

        $data = [
            'base' => 'data:image/jpeg;base64,' . $base64Image,
            'onlineclass' => $course->title,
            'trainer' => $course->Trainer->first_name.' '.$course->Trainer->last_name,
            'post' => $course->Trainer->function,
            'name' =>  Auth::user()->first_name.' '. Auth::user()->last_name,
            'id' => 'BSP'.Carbon::now()->format('y').$test_id.Auth::user()->id.$course->Trainer->first_name[0].$course->Trainer->last_name[0],
        ];
        // dd($data);
        $dompdf = new Dompdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $dompdf->setPaper('letter', 'landscape');
        $dompdf->set_option('chroot', '/');
        $dompdf->loadHtml(view('site.courses.quiz.certificate', $data)->render());
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('mon-fichier-pdf.pdf');
        // return $pdf->download('opk.pdf');
    }

    // public function downloadCertificate(){
    //     // Chemin vers l'image à convertir
    //     $path = asset('site/assets/subscriptions/certificate.jpg');

    //     // Récupérer le contenu de l'image
    //     $imageData = file_get_contents($path);

    //     // Convertir l'image en base64
    //     $base64 = base64_encode($imageData);

    //     // Configurer Dompdf
    //     $options = new Options();
    //     $options->setTempDir('temp');

    //     // Créer une instance de Dompdf
    //     $dompdf = new Dompdf();
    //     $dompdf->setOptions($options);

    //     // Passer le base64 en tant que variable à la vue
    //     $data = ['base64Image' => $base64];

    //     // Charger la vue avec les données
    //     $html = view('site.courses.quiz.certificate', $data)->render();

    //     // Charger le HTML dans Dompdf et générer le PDF
    //     $dompdf->loadHtml($html);
    //     $dompdf->render();

    //     // Renvoyer le PDF en tant que téléchargement
    //     return $dompdf->stream('mon-fichier-pdf.pdf');
    // }
}
