<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendMailExpiredAtributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'query:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a Daily email to all users in a group  with with atributes that will expiry in next 2 weeks';

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
        $atributes = \App\Models\Atribute::where('expiry_date', \Carbon\carbon::now()->addDays(15)->format('Y-m-d'))->get();

        if ($atributes) {

            foreach ($atributes as $atribute) {

                $team_id = $atribute->team_id;
                $team = \App\Models\Team::findOrFail($team_id);
                $user = $team->owner()->first();

                $data = ['atribute' => $atribute,
                    'user' => $user
                ];
                Mail::send('email.atributesexpired', $data, function ($message) use ($user) {

                    $message->to($user->email, $user->name)->subject('test mail from mailgun asset')->from('asset@asset.com', 'Asset Site');
                });


            }

        }
    }
}
