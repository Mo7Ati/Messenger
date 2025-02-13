<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('conversations', [ConversationController::class, 'index']);
    Route::get('conversations/{conversation}', [ConversationController::class, 'show']);
    Route::post('conversations/{conversation}/participants', [ConversationController::class, 'addParticipant']);
    Route::delete('conversations/{conversation}/participants', [ConversationController::class, 'removeParticipant']);

    Route::get('conversations/{id}/messages', [MessagesController::class, 'index']);
    Route::post('messages', [MessagesController::class, 'store']);
    Route::delete('messages/{id}', [MessagesController::class, 'destroy']);

    Route::post('messages/{id}/read', [MessagesController::class, 'markAsRead']);

    ROUTE::post('groups', [GroupsController::class, 'store']);

});
