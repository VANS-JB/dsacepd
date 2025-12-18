<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reclamation;

class ReclamationController extends Controller
{
    /**
     * Affiche toutes les réclamations faites par les demandeurs
     */
    public function index()
    {
        $reclamations = Reclamation::with('demande.user')->latest()->paginate(10);

        return view('admin.reclamations.index', compact('reclamations'));
    }

    /**
     * Affiche le détail d’une réclamation
     */
    public function show($id)
    {
        $reclamation = Reclamation::with('demande.user')->findOrFail($id);
        return view('admin.reclamations.show', compact('reclamation'));
    }
}