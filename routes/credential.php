<?php

use App\Http\Controllers\CredentialRouteController;
use App\Http\Controllers\CredentialRoutingGroupController;
use App\Http\Controllers\CredentialUserController;
use App\Http\Controllers\MasterLoggingController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'credential'], function(){
    Route::group(['prefix' => 'user'], function(){
        Route::get('/', [CredentialUserController::class, 'index'])->name('credential.user.index')->middleware('auth');
        Route::post('/create', [CredentialUserController::class, 'store'])->name('credential.user.store')->middleware('auth');
        Route::get('/{id}/edit', [CredentialUserController::class, 'edit'])->name('credential.user.edit')->middleware('auth');
        Route::post('/{id}/edit', [CredentialUserController::class, 'update'])->name('credential.user.update')->middleware('auth');
        Route::get('/{id}/delete', [CredentialUserController::class, 'destroy'])->name('credential.user.destroy')->middleware('auth');
    });
    Route::group(['prefix' => 'route'], function(){
        Route::get('/', [CredentialRouteController::class, 'index'])->name('credential.route.index')->middleware('auth');
        Route::post('/create', [CredentialRouteController::class, 'store'])->name('credential.route.store')->middleware('auth');
        Route::get('/{id}/edit', [CredentialRouteController::class, 'edit'])->name('credential.route.edit')->middleware('auth');
        Route::post('/{id}/edit', [CredentialRouteController::class, 'update'])->name('credential.route.update')->middleware('auth');
        Route::get('/{id}/delete', [CredentialRouteController::class, 'destroy'])->name('credential.route.destroy')->middleware('auth');
    });
    Route::group(['prefix' => 'routing-group'], function(){
        Route::get('/', [CredentialRoutingGroupController::class, 'index'])->name('credential.routing-group.index')->middleware('auth');
        Route::post('/create', [CredentialRoutingGroupController::class, 'store'])->name('credential.routing-group.store')->middleware('auth');
        Route::get('/{id}/edit', [CredentialRoutingGroupController::class, 'edit'])->name('credential.routing-group.edit')->middleware('auth');
        Route::post('/{id}/edit', [CredentialRoutingGroupController::class, 'update'])->name('credential.routing-group.update')->middleware('auth');
        Route::get('/{id}/delete', [CredentialRoutingGroupController::class, 'destroy'])->name('credential.routing-group.destroy')->middleware('auth');
    });
    Route::group(['prefix' => 'logging'], function(){
        Route::get('/', [MasterLoggingController::class, 'index'])->name('credential.logging.index')->middleware('auth');
        Route::post('/create', [MasterLoggingController::class, 'store'])->name('credential.logging.store')->middleware('auth');
        Route::get('/{id}/edit', [MasterLoggingController::class, 'edit'])->name('credential.logging.edit')->middleware('auth');
        Route::post('/{id}/edit', [MasterLoggingController::class, 'update'])->name('credential.logging.update')->middleware('auth');
        Route::get('/{id}/delete', [MasterLoggingController::class, 'destroy'])->name('credential.logging.destroy')->middleware('auth');
    });
});