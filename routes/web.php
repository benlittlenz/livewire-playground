<?php


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

Route::post('/contact', function (Request $request) {
    $contact = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'message' => 'required',
    ]);

    Mail::to('andre@andre.com')->send(new ContactFormMailable($contact));

    return back()->with('success_message', 'We received your message successfully and will get back to you shortly!');
});
