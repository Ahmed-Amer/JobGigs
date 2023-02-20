<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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

Route::get('/', [ListingController::class , 'index']);

//use response method to send html and specific status
//you can also send specific header or custom one like foo
// Route::get('/hello', function () {
//     return response('<h1>welcome</h1>' , 200)
//             ->header('Content-Type' , 'text/plain')
//             ->header('foo' , 'bar');
// });

//route with parameter with regular expression
// Route::get('/posts/{id}', function ($id) {
//     return response('post' . $id);
// })->where('id' , '[0-9]+');

//get query parameter using request object
// Route::get('/search', function (Request $request) {
//     return response('Name : ' . $request->name);
// });

//listing manage route
Route::get('/listings/manage', [ListingController::class , 'manage'])->middleware('auth');


//listings routes (have middleware auth in controller constructor)
Route::resource('listings' , ListingController::class);



//Auth routes show register form
Route::get('/register', [UsersController::class , 'create'])->middleware('guest');

//Auth routes store user
Route::post('/users', [UsersController::class , 'store']);

//Auth routes logout
Route::post('/logout', [UsersController::class , 'logout'])->middleware('auth');

//Auth routes show login form (naming it as login solve issue with Auth Middleware)
Route::get('/login', [UsersController::class , 'login'])->name('login')->middleware('guest');

//Auth routes authenticate user
Route::post('/users/login', [UsersController::class , 'authenticate']);

