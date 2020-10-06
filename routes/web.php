<?php


use App\Models\Post;
use Illuminate\Http\Request;
use App\Mail\ContactFormMailable;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/register' , Register::class);

Route::get('/', function () {
    return view('examples');
});

Route::get('/post/{post}', function (Post $post) {
    return view('post.show', [
        'post' => $post,
    ]);
})->name('post.show');

Route::post('/contact', function (Request $request) {

});
