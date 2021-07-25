<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clientes;
use App\Http\Controllers\Pagamentos;
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

Route::get('/', [Clientes::class, 'indexOne']);
Route::get('/clientes', [Clientes::class, 'indexTwo']);
Route::get('/pagamentos', [Pagamentos::class, 'indexView']);