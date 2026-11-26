<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/blog/{post:slug}', [LandingController::class, 'showPost'])->name('blog.show');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:100'],
        'email'   => ['required', 'email', 'max:150'],
        'subject' => ['nullable', 'string', 'max:150'],
        'message' => ['required', 'string', 'max:3000'],
        'website' => ['prohibited'], // honeypot
    ]);

    ContactMessage::create($data + ['ip_address' => $request->ip()]);

    return redirect(route('landing').'#contact')->with('success', 'Pesan terkirim, terima kasih!');
})->middleware('throttle:5,1')->name('contact.store');
