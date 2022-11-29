<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\AgendaController;
use App\Http\Livewire\ArchivesController;
use App\Http\Livewire\Client\AgendaDetail;
use App\Http\Livewire\Client\BeasiswaDetail;
use App\Http\Livewire\Client\HomeUser;
use App\Http\Livewire\Client\RegisterAnggota;
use App\Http\Livewire\CrudGenerator;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Informasi\BeasiswaController;
use App\Http\Livewire\KontakController;
use App\Http\Livewire\Master\JenisAnggotaController;
use App\Http\Livewire\Master\JenisArsipController;
use App\Http\Livewire\Member\InformasiLayanan;
use App\Http\Livewire\Member\ProfileOrganisasi;
use App\Http\Livewire\Member\UpdateProfile;
use App\Http\Livewire\MemberController;
use App\Http\Livewire\OrganizationProfileController;
use App\Http\Livewire\PrefviewPdfController;
use App\Http\Livewire\Settings\Menu;
use App\Http\Livewire\Table\JenisAnggotaTable;
use App\Http\Livewire\UserManagement\Permission;
use App\Http\Livewire\UserManagement\PermissionRole;
use App\Http\Livewire\UserManagement\Role;
use App\Http\Livewire\UserManagement\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomeUser::class)->name('home.user');
Route::get('/agenda-detail/{agenda_id?}', AgendaDetail::class)->name('agenda-detail');
Route::get('/beasiswa-detail/{beasiswa_id?}', BeasiswaDetail::class)->name('beasiswa-detail');
Route::get('/daftar', RegisterAnggota::class)->name('register-anggota');

Route::post('login', [AuthController::class, 'login'])->name('admin.login');
Route::group(['middleware' => ['auth:sanctum', 'verified', 'user.authorization']], function () {
    // Crud Generator Route
    Route::get('/crud-generator', CrudGenerator::class)->name('crud.generator');

    // user management
    Route::get('/permission', Permission::class)->name('permission');
    Route::get('/permission-role/{role_id}', PermissionRole::class)->name('permission.role');
    Route::get('/role', Role::class)->name('role');
    Route::get('/user', User::class)->name('user');
    Route::get('/menu', Menu::class)->name('menu');

    // App Route
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Master data
    Route::get('/profil-organisasi', OrganizationProfileController::class)->name('profil-organisasi');
    Route::get('/kontak', KontakController::class)->name('kontak');
    Route::get('/agenda', AgendaController::class)->name('agenda');
    Route::get('/anggota', MemberController::class)->name('anggota');
    // Route::get('/arsip', ArchivesController::class)->name('arsip');
    Route::get('/jenis-anggota', JenisAnggotaController::class)->name('jenis-anggota');
    Route::get('/jenis-arsip', JenisArsipController::class)->name('jenis-arsip');
    Route::get('/beasiswa', BeasiswaController::class)->name('beasiswa');

    Route::get('/preview/{file?}', PrefviewPdfController::class)->name('preview');
    Route::get('/arsip/1', ArchivesController::class)->name('arsip.satu');
    Route::get('/arsip/2', ArchivesController::class)->name('arsip.dua');
    Route::get('/arsip/3', ArchivesController::class)->name('arsip.tiga');

    Route::get('/update-profile', UpdateProfile::class)->name('update-profile');
    Route::get('/informasi-layanan', InformasiLayanan::class)->name('informasi-layanan');
    Route::get('/profile-organisasi', ProfileOrganisasi::class)->name('profile-organisasi');
});
