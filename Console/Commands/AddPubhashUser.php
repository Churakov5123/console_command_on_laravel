<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\DB;

class AddPubhashUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addpubhashuser:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Добавление сгенерированных hash в поле Publickey  для всех юзеров';

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

        $users = User::all();
        $sol = "Инсайд такой инсайд";
        $allId = [];
        foreach ($users as $user) {
            $allId[] = $user->id;
        }
        foreach ($allId as $id) {
            $hash = hash('sha512', $id . $sol);
            $UseModel = User::findOrFail($id);
            $UseModel->public_key = $hash;
            $UseModel->save();
        }
        $this->info('Процедура Добавлення hash  по каждому id завершена!');
    }
}
