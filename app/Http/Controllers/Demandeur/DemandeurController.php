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

         if (! $request->hasFile('photo_releve') || ! $request->file('photo_releve')->isValid()) {
            return back()->withErrors(['photo_releve' => 'Le fichier relevé n’a pas été reçu ou est invalide.'])->withInput();
        }
        if (! $request->hasFile('photo_naissance') || ! $request->file('photo_naissance')->isValid()) {
            return back()->withErrors(['photo_naissance' => 'Le fichier acte de naissance n’a pas été reçu ou est invalide.'])->withInput();
        }

        $demande = new Demande();
        $demande->photo_releve = $request->file('photo_releve')->store('releves', 'public');
        $demande->photo_naissance = $request->file('photo_naissance')->store('naissances', 'public');
        $demande->id_users = auth()->id(); // lien avec l’utilisateur connecté
        $demande->created_by = auth()->id();
        $demande->statut = 'en attente';
        $demande->reference = 'DEM-' . strtoupper(uniqid());
        $demande->save();

         // ✅ Génération d’une référence unique


        

        // Mise à jour du statut de la demande
        

        

        return redirect()->route('demandeur.suivi')->with('success', 'Votre demande a été soumise avec succès.');
    }

    /**
     * Suivi des demandes de l’utilisateur connecté
     */
    public function suivi()
    {
       

        $demandes = Demande::where('id_users', auth()->id())
                   ->orderBy('created_at', 'desc')
                   ->get();

        $notifications = \App\Models\UserNotification::where('id_users', auth()->id())
                    ->orderBy('date_notification', 'desc')
                    ->get();

        return view('demandeur.suivi', compact('demandes', 'notifications'));


       
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
