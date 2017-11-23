<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CommandFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importera kunder';

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

        /*$users = User::all();
        $post = Post::find(1);
        $post->comments()->where("user_id", "=", 1);
        $post->comments;
        foreach($users as $user) {
            //När ni skriver det här så görs ett databasanrop
            //Blir antal users+1 databasanrop totalt.
            $user->phone->phone_number;
            $users->comments;
        }*/
    }


}
