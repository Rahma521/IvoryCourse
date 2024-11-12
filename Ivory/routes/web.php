<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/AdminPanel/UploadPhotos', [HomeController::class, 'uploadFromEditor'])->name('admin.images.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('SwitchLang/{lang}',function($lang){
    session()->put('Lang',$lang);
    app()->setLocale($lang);
    if (auth()->check()) {
        $user = App\Models\User::find(auth()->user()->id)->update(['language'=>$lang]);
    }
	return Redirect::back();
});


Route::get('AdminPanel/changeTheme',[AdminUsersController::class, 'changeTheme'])->name('changeTheme');
