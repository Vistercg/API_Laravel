<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return response()->json(Auth::user());
    }

    return response()->json(["message"=>"login error"], 401);
})->middleware('web');

Route::get('/api/me', function (Request $request) {
    $user = Auth::user();
    if($user){
        return response()->json($user);
    }else{
        return response()->json([], 401);
    }
})->middleware('web');

Route::get('/api/logout', function (Request $request) {
    Auth::logout();
    return response()->json([]);
})->middleware('web');
