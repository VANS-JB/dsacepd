<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\DemandeurAuthController;
use App\Http\Controllers\Admin\DemandeController;
use App\Http\Controllers\Demandeur\DemandeurController;
use App\Http\Controllers\Admin\InfoAttestationController;
use App\Http\Controllers\Admin\ReclamationController;
use App\Http\Controllers\Admin\AttestationController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Demandeur\NotificationController as DemandeurNotificationController;
use App\Http\Controllers\Admin\DashboardController;



Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Auth routes for admin and agent
// Formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Traitement de la connexion
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard commun admin/agent
Route::get('/dashboard', function () {
    return view('dashboard'); // Vue commune
})->name('dashboard')->middleware('auth');





// Auth routes for demandeur
// Note: DemandeurAuthController is used for demandeur registration and login
// Formulaire d'inscription
Route::get('/register', [DemandeurAuthController::class, 'showRegisterForm'])->name('register');

// Traitement de l'inscription
Route::post('/register', [DemandeurAuthController::class, 'register'])->name('register.post');

// Connexion demandeur
Route::post('/demandeur/login', [DemandeurAuthController::class, 'login'])->name('demandeur.login');

// Site de demande (après connexion)
Route::get('/', function () {
    return view('welcome'); // Vue spécifique demandeur
})->name('welcome'); 

// ->middleware('auth');



Route::middleware('auth')->group(function () {
    Route::resource('admin/demandes', DemandeController::class);
});



Route::middleware('auth')->group(function () {
    Route::get('/demandeur/demande', [DemandeurController::class, 'create'])->name('demandeur.demande');
    Route::post('/demandeur/demande', [DemandeurController::class, 'store'])->name('demandeur.demande.store');

    Route::get('/demandeur/suivi', [DemandeurController::class, 'suivi'])->name('demandeur.suivi');

    Route::get('/demandeur/reclamation/{demandeId}', [DemandeurController::class, 'reclamationForm'])->name('demandeur.reclamation');
    Route::post('/demandeur/reclamation/{demandeId}', [DemandeurController::class, 'reclamationStore'])->name('demandeur.reclamation.store');
});




Route::middleware('auth')->group(function () {
    Route::get('/infoattestations', function () {
        return redirect()->route('attestations.index');
    })->name('infoattestation.index');

    Route::get('/infoattestation/create/{demandeId}', [InfoAttestationController::class, 'create'])->name('infoattestation.create');
    Route::post('/infoattestation/store', [InfoAttestationController::class, 'store'])->name('infoattestation.store');
});




Route::middleware('auth')->group(function () {
    Route::get('/reclamations', [ReclamationController::class, 'index'])->name('reclamations.index');
    Route::get('/reclamations/{id}', [ReclamationController::class, 'show'])->name('reclamations.show');
});



Route::middleware('auth')->group(function () {
    Route::get('/attestations', [AttestationController::class, 'index'])->name('attestations.index');
    Route::get('/attestations/{id}/print', [AttestationController::class, 'print'])->name('attestations.print');
});








Route::middleware('auth')->group(function () {
    Route::get('/attestations', [AttestationController::class, 'index'])->name('attestations.index');
    Route::get('/attestation/create', [AttestationController::class, 'create'])->name('attestation.create');
    Route::post('/attestation', [AttestationController::class, 'store'])->name('attestation.store');
    Route::get('/attestation/{id}/edit', [AttestationController::class, 'edit'])->name('attestation.edit');
    Route::put('/attestation/{id}', [AttestationController::class, 'update'])->name('attestation.update');
    Route::delete('/attestation/{id}', [AttestationController::class, 'destroy'])->name('attestation.destroy');
    Route::get('/attestation/{id}/print', [AttestationController::class, 'print'])->name('attestation.print');
});




Route::middleware(['auth', 'role:demandeur'])->group(function () {
    Route::get('/mes-notifications', [DemandeurNotificationController::class, 'index'])->name('demandeur.notifications');
});




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});