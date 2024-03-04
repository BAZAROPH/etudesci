<?php

namespace App\Http\Controllers;

use SplFileObject;
use App\Models\User;
use App\Models\Events;
use League\Csv\Writer;
use SplTempFileObject;
use App\Models\Courses;
use App\Models\Articles;
use Illuminate\Http\Request;
use App\Models\Certifications;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    //
    public function adminIndex(){
        $today = Carbon::now();
        $week = Carbon::now()->subWeek()->startOfWeek();
        $month = Carbon::now()->startOfMonth();

        $today_users = count(User::whereDate('created_at', '>=', $today)->get());
        $week_users = count(User::whereDate('created_at', '>=', $week)->get());
        $month_users = count(User::whereDate('created_at', '>=', $month)->whereNull('role')->get());
        $total_users = count(User::all());
        $admin_users = count(User::whereHas('role', function($query){
            $query->where('label', 'admin');
        })->get());

        return view('admin.home',[
            'today_users' => $today_users,
            'week_users' => $week_users,
            'month_users' => $month_users,
            'total_users' => $total_users,
            'admin_users' => $admin_users,
        ]);
    }

    public function formatContact(Request $request){
        $request->validate([
            'csvfile' => 'required|file|mimes:csv',
            'type' => 'required',
        ]);
        require_once app_path('functions.php');

        $csvfile = $request->csvfile;
        $file = new SplFileObject($csvfile);
        $file->setFlags(SplTempFileObject::READ_CSV);
        $contacts = [];
        foreach ($file as $index=>$row) {
            if(isset($row[9])){
                array_push($contacts, validateFormat($row[9]));
            }else{
                array_push($contacts, '');
            }
        }
        $contacts[0] = 'contacts';

        $valid_contacts = [];
        $invalid_contacts = [];
        $writer1 = Writer::createFromString('');
        $writer2 = Writer::createFromString('');

        foreach ($contacts as $key => $contact) {
            if(strlen($contact) == 13){
                if(count($valid_contacts) == 0){
                    $writer1->insertOne(['Contacts valides']);
                }
                array_push($valid_contacts, $contact);
                $writer1->insertOne([$contact]);
            }else{
                array_push($invalid_contacts, $contact);
                $writer2->insertOne([$contact]);
            }
        }

        // $writer1->insertAll($valid_contacts);
        $csv1 = $writer1->getContent();

        // $writer2->insertAll($invalid_contacts);
        $csv2 = $writer2->getContent();

        $filename = $request->type == 'valid' ? 'valides.csv' : 'invalides.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        $final_csv = $request->type == 'valid' ? $csv1 :  $csv2;
        return response()->streamDownload(function () use ($final_csv) {
            echo $final_csv;
        }, $filename, $headers);
        // return redirect()->back();

    }

    public function index(){
        $left_articles = Articles::where('published', 1)->where('vertical_slide', 1)->orderBy('created_at', 'ASC')->get();
        $right_articles = Articles::where('published', 1)->where('horizontal_slide', 1)->orderBy('created_at', 'ASC')->get();
        $courses = Courses::where('published', 1)->orderBy('created_at', 'ASC')->get();
        $certifications = Certifications::whereDate('start_date', '>=', Carbon::now())->get();
        $events = Events::where('start_date', '>=', Carbon::now())->where('published', 1)->get();
        return view('site.home', [
            'courses' => $courses,
            'left_articles' => $left_articles,
            'right_articles' => $right_articles,
            'certifications' => $certifications,
            'events' => $events,
        ]);
    }

    public function partners(){
        return view('site.crm.partners');
    }
}
