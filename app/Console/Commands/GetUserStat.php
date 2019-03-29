<?php

namespace App\Console\Commands;

use App\StatisticUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetUserStat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stat:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $users_total = User::all()->count();
            $user_today = User::whereBetween('created_at', [Carbon::yesterday(), Carbon::now()])->count();
            $stat = new StatisticUser();
            $stat->fill([
                'total' => $users_total,
                'today' => $user_today,
                'date' => Carbon::yesterday()->format('Y-m-d')
            ]);
            $stat->save();
        } catch (\Exception $error) {
            Log::warning('There exception happened in UserStat command. Message: '.$error->getMessage());
        }
    }
}
