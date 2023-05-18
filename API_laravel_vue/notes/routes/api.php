<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [ApiTokenController::class, 'login']);
Route::post('/auth/register', [ApiTokenController::class, 'register']);
//Route::get('/auth/user', [ApiTokenController::class, 'show']);
Route::post('/auth/logout', [ApiTokenController::class, 'logout']);

// private posts and authors routes
Route::group(['middleware' => ['auth:sanctum']], function () {
// private post routes
    Route::get('/notes', [NoteController::class, 'show'])->name('note.show');
    Route::post('/notes', [NoteController::class, 'create'])->name('note.add');
    Route::get('/notes/{id}', [NoteController::class, 'showOne'])->name('note.showOne');
    Route::put('/notes/{id}', [NoteController::class, 'edit'])->name('note.edit');
    Route::delete('/notes/{id}', [NoteController::class, 'delete'])->name('note.delete');
});
