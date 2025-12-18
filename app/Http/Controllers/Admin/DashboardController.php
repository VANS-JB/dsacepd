<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\InfoAttestation;
use App\Models\Reclamation;
use App\Models\UserNotification;


class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques
        $totalDemandes = Demande::count();
        $attestationsGenerees = InfoAttestation::count();
        $totalReclamations = Reclamation::count();
        $totalNotifications = UserNotification::count();

        // Liste des demandes avec demandeur
        $demandes = Demande::with('user')->latest()->paginate(10);

        return view('dashboard', compact(
            'totalDemandes',
            'attestationsGenerees',
            'totalReclamations',
            'totalNotifications',
            'demandes'
        ));
    }

    
}