<?php

namespace App\Console\Commands;

use App\Models\Subscriptions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerifySubscriptionsStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:subscriptions-state';

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
        $subscriptions = Subscriptions::where('state', '>=', 1)->get();
        for ($i=0; $i < count($subscriptions) ; $i++) {
            if($subscriptions[$i]->end < Carbon::now())
            $subscriptions[$i]->update([
                'state' => -1,
                'token' => null,
            ]);
            // $user = User::where('id', $subscriptions[$i]->id)->hasNot('subscription', function($query){
            //     $query->where('state', '>=', 1);
            // })->first();
        }
        return Command::SUCCESS;
    }
}
