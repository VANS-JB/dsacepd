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
     * Vue imprimable d’une attestation
     */
    public function print($id)
    {
        // Recherche par id_demande (l'URL fournit l'id de la demande)
        $attestation = InfoAttestation::with('demande.user')->where('id_demande', $id)->first();

        // Si aucune attestation liée à cette demande, retourner 404 proprement
        if (! $attestation) {
            abort(404, "Attestation introuvable pour la demande #{$id}.");
        }

        return view('admin.attestations.print', compact('attestation'));
    }
}