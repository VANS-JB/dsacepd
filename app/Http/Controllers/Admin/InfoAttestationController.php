<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoAttestation;

class InfoAttestationController extends Controller
{
    public function create($demandeId)
    {

        $demande = Demande::findOrFail($demandeId);
        return view('admin.infoattestation.create', compact('demande'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_complet' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'ecole' => 'required|string',
            'numero_table' => 'required|integer',
            'session' => 'required|string',
            'centre' => 'required|string',
            'numero_registre' => 'required|string',
            'id_demande' => 'required|exists:demandes,id',
        ]);

        InfoAttestation::create($request->all());

        return redirect()->route('demandes.index')->with('success', 'Informations d’attestation enregistrées.');
    }
}