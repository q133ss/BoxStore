<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('notes.index'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

    Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])->name('notes.edit')->can('update', 'note');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update')->can('update', 'note');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy')->can('delete', 'note');
    Route::patch('/notes/{note}/toggle-pin', [NoteController::class, 'togglePin'])->name('notes.togglePin')->can('update', 'note');
});
