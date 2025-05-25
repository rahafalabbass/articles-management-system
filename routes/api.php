<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpertController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth routes
    Route::controller(AuthController::class)->group(function(){
        Route::post('/register','register');
        Route::post('/login','login');
    });

Route::get('/',[ArticleController::class,'index']);
Route::get('/article-info/{id}',[ArticleController::class,'articleInformation']);

//dashboard
// Route::get('all-articles',[ExpertController::class,'getArticles']);
// Route::post('add-article',[ExpertController::class,'addArticle']);
// Route::post('get-article/{id}',[ExpertController::class,'oneArticle']);
// Route::post('edit-article/{id}',[ExpertController::class,'editArticle']);
// Route::delete('delete-article/{id}',[ExpertController::class,'deleteArticle']);
// Route::delete('delete-article-image/{id}',[ExpertController::class,'deleteImage']);

// Route::post('/add-comment',[ExpertController::class,'addComment']);
// Route::get('/all-comments',[ExpertController::class,'getComments']);
// Route::post('/edit-comment/{id}',[ExpertController::class,'editComment']);
// Route::delete('/delete-comment/{id}',[ExpertController::class,'deleteComment']);





