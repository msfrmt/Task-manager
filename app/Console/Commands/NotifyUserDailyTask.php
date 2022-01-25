<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Tasks;
use Illuminate\Console\Command;
use App\Notifications\NotifyAllUser;

class NotifyUserDailyTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'You have 2 task for today.';

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
     * @return int
     */
    public function handle()
    {
        
        $users = User::all();
        
        foreach($users as $user) {
            $user->notify(new NotifyAllUser());
            $this->info('email sent to user' . $user->email);
        }

        return 0;
    }
}
