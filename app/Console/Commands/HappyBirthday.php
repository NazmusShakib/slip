<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use App\User;

class HappyBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a Happy birthday message to users via SMS.';

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
        $users = User::all();//whereBirthDate(date('Y-m-d | h:i:sa'))->get();

        foreach( $users as $user ) {
            //if($user->has('email')) {


           /* Mail::send([],[], function ($message) use ($user) {
                $message->to()
                        ->from()
                        ->subject()
                        ->setBody();
            });
            */

                Mail::send([], [], function ($message) use ($user){
                    $message->to($user->email)
                        ->subject('Test crone Mail')
                        ->from('no-reply@eskerjay.com')
                    // here comes what you want
                    //->setBody('Hi, welcome user!'); // assuming text/plain
                    // or:
                    ->setBody('<h1>Hi, welcome user!</h1>', 'text/html'); // for HTML rich messages
                });

                /*SMS::to($user->cellphone)
                    ->msg('Dear ' . $user->fname . ', I wish you a happy birthday!')
                    ->send();*/
           // }
        }

       // $this->info($users);
        $this->info('The happy birthday messages were sent successfully!');
    }
}
