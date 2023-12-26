<?php

use App\Models\Gallery;
use App\Mail\ContactMail;
use App\Models\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\SquareController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
 
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
// $json = Storage::disk('local')->get('json/gallery.json');
// $images = json_decode($json, true);
// $images = json_decode(file_get_contents(public_path('gallery.json')), true);
// dd($images);

// foreach ($images as $image) {
//     echo($image['file']);
// }

// dd(Notification::checkForNotifications());



Route::get('/', function () {
    // $images = json_decode(Storage::disk('local')->get('json/gallery.json'), true);
    // return view('welcome', compact('images'));
    // dd(Gallery::all()[0]);
    return view('home', [ 'galleries' => Gallery::orderBy('seq-no', 'asc')->get() ]);
    // return view('home', [ 'galleries' => Gallery::getAll() ]);
    // return view('home', [ 'galleries' => Gallery::all()[0]]);
});

// Route::get('/gallery/{gallery}', [GalleryController::class, 'show']);
// Route::get('/gallery/{gallery}', function (Gallery $gallery) {
//     // return response('to gallery ' . $id);
//     return view('gallery', ['gallery' => $gallery]);
// });
Route::get('/gallery/{id}', function ($id) {
    $gallery = Gallery::find($id);
    if ($gallery) {
        return view('gallery', ['gallery' => $gallery]);
    } else {
        abort('404');
    }
});

Route::get('/about', function () {
    // return response('to gallery ' . $id);
    return view('about');
});

Route::get('/books', function () {
    // return response('to gallery ' . $id);
    return view('books');
});

// Route::get('/contact', function () {
//     // return response('to gallery ' . $id);
//     return view('contact');
// });

// Route::get('/sendmail', function () {
//     // return response('to gallery ' . $id);
//     Mail::to('borromeo@momo.so-net.ne.jp')->send(new ContactMail());
//     // return view('contact');
// });

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact/validate', [ContactController::class, 'validateForm'])->name('contact.validate');
// Route::post('/contact/submit', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/square/{id}', function ($id) {
    return view('square', ['gallery' => Gallery::find($id)]);
});

Route::post('/square/validate/{id}', [SquareController::class, 'validateForm'])->name('square.validate');
// Route::get('/square/createPayment', [SquareController::class, 'initiatePayment'])->name('square.initiatePayment');
Route::post('/square/createPayment', [SquareController::class, 'createPayment'])->name('square.createPayment');