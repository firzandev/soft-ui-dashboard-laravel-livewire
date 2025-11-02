<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Http;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/authors', [AuthorController::class, 'index']);

Route::get('/stock-sectors', function () {
    $response = Http::get('https://www.pasardana.id/api/StockSearchResult/GetAll?pageBegin=0&pageLength=100&sortField=Code&sortOrder=ASC');
    return $response->json();
});