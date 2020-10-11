<?php

namespace App\Console\Commands;

use Validator;
use App\User;
use Illuminate\Console\Command;

class AdminInitial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin user: {name} {email} {password}';

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
        $validator = Validator::make($this->argument(),[
                'name' => 'required',
                'email' => 'required|unique:users|email',
                'password' => 'required'
            ]);
        if ($validator->fails()) {
            $messages = $validator->messages();
            $this->error($messages);
        }else{
            $user = new User;
            $user->name = $this->argument('name');
            $user->email = $this->argument('email');
            $user->password = bcrypt($this->argument('password'));
            $user->role = 'admin';
            $user->valid = 1;
            $user->confirmed = 1;
            $user->save();    
        }
    }
}
