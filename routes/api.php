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

    $response = Http::withHeaders([
        'User-Agent'      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:144.0) Gecko/20100101 Firefox/144.0',
        'Accept'          => 'application/json, text/plain, */*',
        'Accept-Language' => 'en-US,en;q=0.5',
        'Referer'         => 'https://pasardana.id/stock/search',
        'Pragma'          => 'no-cache',
        'Cache-Control'   => 'no-cache'
    ])
        // ->withOptions([
        //     // This setting prevents Guzzle/cURL from automatically decoding 
        //     // the response based on the Content-Encoding header, fixing cURL error 61.
        //     'decode_content' => false,
        // ])
        ->get('https://pasardana.id/api/StockSearchResult/GetAll', [
            // These are your query parameters
            'pageBegin'  => 0,
            'pageLength' => 100,
            'sortField'  => 'Code',
            'sortOrder'  => 'ASC',
        ]);

    // Handle response as the body will be the raw JSON string
    if ($response->successful()) {
        return json_decode($response->body(), true);
    }

    // Handle failure
    return response()->json(['error' => 'Failed to fetch stock data.'], $response->status());
});
