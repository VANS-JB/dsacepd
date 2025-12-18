<?php

namespace App\Http\Controllers\Demandeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Reclamation;

class DemandeurController extends Controller
{
    /**
     * Formulaire de demande
     */
    public function create()
    {
        return view('demandeur.demande');
    }

    /**
     * Enregistrement d’une nouvelle demande
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
        $demande->id_users = auth()->id(); // lien avec l’utilisateur connecté
        $demande->save();

        return redirect()->route('demandeur.suivi')->with('success', 'Votre demande a été soumise avec succès.');
    }

    /**
     * Suivi des demandes de l’utilisateur connecté
     */
    public function suivi()
    {
        $demandes = Demande::where('id_users', auth()->id())->latest()->get();
        return view('demandeur.suivi', compact('demandes'));
    }

    /**
     * Formulaire de réclamation
     */
    public function reclamationForm($demandeId)
    {
        return view('demandeur.reclamation', compact('demandeId'));
    }

    /**
     * Enregistrement d’une réclamation
     */
    public function reclamationStore(Request $request, $demandeId)
    {
        $request->validate([
            'objet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Reclamation::create([
            'objet' => $request->objet,
            'message' => $request->message,
            'id_demande' => $demandeId,
        ]);

        return redirect()->route('demandeur.suivi')->with('success', 'Votre réclamation a été envoyée.');
    }
}
