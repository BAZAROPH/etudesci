<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\OnlineClass;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use App\Mail\DispatchTokenEmail;
use Illuminate\Support\Facades\Mail;

class sendDispatchTokenEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:dispatchTokenEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::whereHas('subscription', function($query){
            $query->where('state', '>=', 1);
        })->where('token', '!=', null)->get();
        $onlineClass = OnlineClass::whereDate('date', '>=', Carbon::now()->format('Y-m-d'))->where('type', 'onlineclass')->orderBy('date', 'ASC')->first();
        if(!is_null($onlineClass)){
            $onWeekBefore = Carbon::parse($onlineClass->date)->subWeek()->format('Y-m-d');
            $oneDayBefore = Carbon::parse($onlineClass->date)->subDay()->format('Y-m-d');
            $today = Carbon::parse($onlineClass->date)->format('Y-m-d');
            if(($onWeekBefore == Carbon::now()->format('Y-m-d')  and Carbon::now()->format('H:i') === '08:00') or ($oneDayBefore == Carbon::now()->format('Y-m-d') and Carbon::now()->format('H:i') == '10:00') or ($today == Carbon::now()->format('Y-m-d') and Carbon::now()->format('H:i') == '18:00')){
                for ($i=0; $i < count($users) ; $i++) {
                    $data = [
                        'first_name' => $users[$i]->first_name,
                        'trainer' => $onlineClass->Trainer->first_name.' '.$onlineClass->Trainer->last_name,
                        'token' => $users[$i]->token,
                        'date' => Carbon::parse($onlineClass->date)->translatedFormat('d F Y'),
                        'hour' => $onlineClass->hour,
                        'onlineClass' => $onlineClass->title,
                        'image' => $onlineClass->getFirstMediaUrl('onlineClass'),
                        'link' => route('onlineClass.open', $onlineClass->slug),
                    ];
                    Mail::to($users[$i]->email)->send(new DispatchTokenEmail($data));
                }
            }
        }


        return Command::SUCCESS;
    }
}
