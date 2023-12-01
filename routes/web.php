<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\KeluargaController;


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
    return view('layout.index');
});

Route::get('keluarga', [KeluargaController::class,'index']);
Route::post('keluarga', [KeluargaController::class,'store']);
Route::get('keluarga/{id}', [KeluargaController::class,'edit']);
Route::put('keluarga/{id}', [KeluargaController::class,'update']);
Route::delete('keluarga/{id}', [KeluargaController::class,'destroy']);
Route::get('tree', [KeluargaController::class,'getFamilyTreeData']);
// Route::get('tree', function () {
//     return view('keluarga.tree');
// });

