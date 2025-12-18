<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoAttestation;

class AttestationController extends Controller
{
    /**
     * Liste des attestations générées
     */
    public function index()
    {
        $attestations = InfoAttestation::with('demande.user')->latest()->paginate(10);
        return view('admin.attestations.index', compact('attestations'));
    }

    /**
     * Affiche une attestation pour impression
     */
    public function show($id)
    {
        $attestation = InfoAttestation::with('demande.user')->findOrFail($id);
        return view('admin.attestations.show', compact('attestation'));
    }
}