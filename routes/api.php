<?php
use App\Http\Controllers\KeluargaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('keluarga', [KeluargaController::class,'index']);
Route::get('keluarga/{id}', [KeluargaController::class,'show']);
Route::post('keluarga', [KeluargaController::class,'store']);
Route::put('keluarga/{id}', [KeluargaController::class,'update']);
Route::delete('keluarga/{id}', [KeluargaController::class,'destroy']);
Route::get('tree', [KeluargaController::class,'getFamilyTreeData']);



// Route::apiResource('keluarga',KeluargaController::class);
