<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $user = new \App\Models\User();
    $user->name = 'Alex';
    $user->email = 'ivanov@web-premier.ru';
    $user->password = Hash::make('123');
    $user->save();
    $this->comment('Done');
})->purpose('Display an inspiring quote');
