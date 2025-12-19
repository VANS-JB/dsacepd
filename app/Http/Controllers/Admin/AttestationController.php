<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoAttestation;
use App\Models\Demande;

class AttestationController extends Controller
{
    public function index()
    {
        $attestations = InfoAttestation::with('demande.user')->latest()->paginate(10);
        return view('admin.attestations.index', compact('attestations'));
    }

    public function create()
    {
        $demandes = Demande::with('user')->get();
        return view('admin.attestations.create', compact('demandes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_demande' => 'required|exists:demandes,id',
            'nom_complet' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'ecole' => 'required|string',
            'numero_table' => 'required|integer',
            'session' => 'required|string',
            'centre' => 'required|string',
            'numero_registre' => 'required|string',
        ]);

        InfoAttestation::create($request->all());

        return redirect()->route('attestations.index')->with('success', 'Attestation créée avec succès.');
    }

    public function edit($id)
    {
        $attestation = InfoAttestation::findOrFail($id);
        return view('admin.attestations.edit', compact('attestation'));
    }

    public function update(Request $request, $id)
    {
        $attestation = InfoAttestation::findOrFail($id);
        $attestation->update($request->all());

        return redirect()->route('attestations.index')->with('success', 'Attestation mise à jour.');
    }

    public function destroy($id)
    {
        InfoAttestation::findOrFail($id)->delete();
        return redirect()->route('attestations.index')->with('success', 'Attestation supprimée.');
    }

    public function print($id)
    {
        $attestation = InfoAttestation::with('demande.user')->findOrFail($id);
        return view('admin.attestations.print', compact('attestation'));
    }
}