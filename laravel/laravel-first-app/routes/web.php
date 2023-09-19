<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BikeController;


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

Route::get('/', [HomeController::class, 'index']) -> name('home.index');
Route::get('/about', [HomeController::class, 'about']) -> name('home.about');
Route::get('/contact', [HomeController::class, 'contact']) -> name('home.contact');

Route::resource('bikes', BikeController::class);

Route::get('/store/{category}/{item}', function ($category=null, $item=null) {
    if(isset($cateogry)){
			if(isset($item)){
        return '현재 스토어에서'.strip_tags($category).'내'.$item.'카테고리를  보고 있습니다';
	    }else{
				return '현재 스토어에서'.strip_tags($category).'카테고리를  보고 있습니다';
			}
		}else{
	    return '현재 스토어에서 모든 제품을 보고 있습니다';
		}
});