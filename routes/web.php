<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/list_orders', function()
{
    $body['title'] = "Body Title";
    $body['content'] = "Body Description";


    $client = new \GuzzleHttp\Client(['verify' => false ]);
    $url = "https://devyearbook.tamu.edu/wp-json/wc/v3/orders";


    $response = $client->get($url, ['auth' => ['ck_ada1311522087bd171304c1b0259cd4f2e832cf4','cs_9ec3432a1c2ea94bef5048a188c5695b9de919e0']]);
    $contents = (string) $response->getBody();
    dd($contents);
});

Route::get('/export', [App\Http\Controllers\OrdersController::class, 'export']);
/*
Route::get('/export', function()
{
    $body['title'] = "Body Title";
    $body['content'] = "Body Description";


    $client = new \GuzzleHttp\Client(['verify' => false ]);
    $url = "https://devyearbook.tamu.edu/wp-json/wc/v3/orders";


    $response = $client->get($url, ['auth' => ['ck_ada1311522087bd171304c1b0259cd4f2e832cf4','cs_9ec3432a1c2ea94bef5048a188c5695b9de919e0']]);
    $contents = (string) $response->getBody();
    dd($contents);
});
*/



