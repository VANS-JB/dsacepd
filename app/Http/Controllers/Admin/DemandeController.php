<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;

class DemandeController extends Controller
{
    /**
     * Affiche la liste des demandes
     */
    public function index()
    {
        $demandes = Demande::with('user')->latest()->paginate(10);
        $agents = User::whereHas('role', function($q){
            $q->where('libelle', 'agent');
        })->get();

        return view('admin.demandes.index', compact('demandes', 'agents'));
    }

    /**
     * Formulaire de création d'une nouvelle demande
     */
    public function create()
    {
        return view('admin.infoattestation.create');
    }

    /**
     * Enregistre une nouvelle demande
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo_releve' => 'required|file|mimes:jpg,png,pdf',
            'photo_naissance' => 'required|file|mimes:jpg,png,pdf',
        ]);

        $demande = new Demande();
        $demande->photo_releve = $request->file('photo_releve')->store('releves');
        $demande->photo_naissance = $request->file('photo_naissance')->store('naissances');
        $demande->user_id = auth()->id();
        $demande->save();

        return redirect()->route('admin.demandes.index')->with('success', 'Demande créée avec succès.');
    }

    

    /**
     * Affiche une demande spécifique
     */
    public function show($id)
    {
        $demande = Demande::with('user')->findOrFail($id);
        return view('admin.demandes.show', compact('demande'));
    }

    /**
     * Formulaire d’édition
     */
    public function edit($id)
    {
        $demande = Demande::findOrFail($id);
        return view('admin.demandes.edit', compact('demande'));
    }

    /**
     * Met à jour une demande
     */
    public function update(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);

        $demande->statut = $request->input('statut');
        $demande->save();

        return redirect()->route('admin.demandes.index')->with('success', 'Demande mise à jour.');
    }

    /**
     * Supprime une demande
     */
    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();

        return redirect()->route('admin.demandes.index')->with('success', 'Demande supprimée.');
    }
}