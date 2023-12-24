<?php

use App\Models\dbUrl;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/main',  [SiteController::class, 'main'])->name('main');

Route::get('/id/{target_id}/{subject_id}',  [SiteController::class, 'table_process'])->name('table.process');
Route::post('/id',[SiteController::class ,'registerPost']) -> name('register.post');

Route::get('/giveurl',  [SiteController::class, 'giveurl_get'])->name('giveurl_get');
Route::post('/giveurl',[SiteController::class ,'giveurl']) -> name('giveurl');
Route::get('/dropdown-schools',[SiteController::class ,'dropdownSchools'])->name('dropdownSchools');


Route::get('/gen-url/{id}', function($id){
    $url = URL::temporarySignedRoute('giveurl_get', now()->addSeconds(1000));
    $dbUrl = dbUrl::create([
        'raw' => $url,
        'municipality_id' => $id,
        'subject_id' => 1,
    ]);

    return view('teacher')->with('url',$url);
})->name('test');


Route::get('/gen/{municipality_id}',  [\App\Http\Controllers\ConsoleController::class, 'createArrUrlsMun'])->name('gen');
