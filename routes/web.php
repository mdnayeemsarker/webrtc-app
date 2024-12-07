<?php

use App\Http\Controllers\WebRTCController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function Ramsey\Uuid\v1;

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route::post('/webrtc/send-offer', [WebRTCController::class, 'sendCallOffer']);
    // Route::post('/webrtc/send-message', [WebRTCController::class, 'sendMessage']);

    Route::get('/chat', function () {
        $user = Auth::user();
        $token = $user->remember_token;
        return view('chat', compact('token'));
    });

});
