<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OperatorDashboardController;
use App\Http\Controllers\MasterKecamatanController;
use App\Http\Controllers\MasterDesaController;
use App\Http\Controllers\MasterJalanController;
use App\Http\Controllers\MasterJembatanController;
use App\Http\Controllers\MasterWisataController;
use App\Http\Controllers\MasterSekolahController;
use App\Http\Controllers\MasterPokmasController;
use App\Http\Controllers\MasterKomoditasController;
use App\Http\Controllers\MasterAnggotaPokmasController;
use App\Http\Controllers\MasterKesehatanPoliController;
use App\Http\Controllers\MasterPasarController;
use App\Http\Controllers\MasterKomoditasPasarController;
use App\Http\Controllers\MasterFasyankesController;
use App\Http\Controllers\MasterGuruController;
use App\Http\Controllers\MasterNakesController;

use App\Http\Controllers\CredentialUserController;
use App\Http\Controllers\CredentialRoutingGroupController;
use App\Http\Controllers\CredentialRouteController;

use App\Http\Controllers\GraphJalanController;
use App\Http\Controllers\GraphJembatanController;
use App\Http\Controllers\GraphKesehatanController;
use App\Http\Controllers\GraphPendidikanController;
use App\Http\Controllers\GraphPertanianController;

use App\Http\Controllers\MasterKunjunganPoliController;
use App\Http\Controllers\MasterKunjunganWisataController;
use App\Http\Controllers\MasterMuridController;
use App\Http\Controllers\MasterStatusJalanController;
use App\Http\Controllers\MasterStatusJembatanController;

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
    return redirect('login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->middleware('auth');
Route::get('dashboard', [OperatorDashboardController::class, 'index'])->middleware('auth');
