<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\User;
use App\Models\InfoAttestation;

class DemandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Demande::with('user')->latest();

        // Filtre par nom
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filtre par dates
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $demandes = $query->paginate(10);

        return view('admin.demandes.index', compact('demandes'));
    }

    public function create()
    {
        $users = User::whereHas('role', fn($q) => $q->where('libelle', 'demandeur'))->get();
        return view('admin.demandes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $messages = [
            'photo_releve.required' => 'Le champ "Relevé photo" est obligatoire.',
            'photo_naissance.required' => 'Le champ "photo naissance" est obligatoire.',
            'photo_releve.file' => 'Le relevé doit être un fichier valide.',
            'photo_naissance.file' => 'La photo de naissance doit être un fichier valide.',
            'photo_releve.mimes' => 'Format autorisé pour le relevé : jpg, png, pdf.',
            'photo_naissance.mimes' => 'Format autorisé pour la photo de naissance : jpg, png, pdf.',
            // autres messages si besoin...
        ];

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'photo_releve' => 'required|file|mimes:jpg,png,pdf',
            'photo_naissance' => 'required|file|mimes:jpg,png,pdf',
            'nom_complet' => 'required|string',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string',
            'ecole' => 'required|string',
            'numero_table' => 'required|integer',
            'session' => 'required|string',
            'centre' => 'required|string',
            'numero_registre' => 'required|string',
        ], $messages);

        // double vérification pour plus de clarté
        if (! $request->hasFile('photo_releve') || ! $request->file('photo_releve')->isValid()) {
            return back()->withErrors(['photo_releve' => 'Le fichier relevé n’a pas été reçu ou est invalide.'])->withInput();
        }
        if (! $request->hasFile('photo_naissance') || ! $request->file('photo_naissance')->isValid()) {
            return back()->withErrors(['photo_naissance' => 'Le fichier acte de naissance n’a pas été reçu ou est invalide.'])->withInput();
        }

        // Stockage des fichiers
        $photoRelevePath = $request->file('photo_releve')->store('releves', 'public');
        $photoNaissancePath = $request->file('photo_naissance')->store('naissances', 'public');

        // Création de la demande avec les chemins des fichiers
        $demande = new Demande();
        // écrire dans la colonne existante 'id_users' (la table n'a pas 'user_id')
        $demande->id_users = $request->input('user_id');
        $demande->photo_releve = $photoRelevePath;
        $demande->photo_naissance = $photoNaissancePath;
        $demande->save();

        // Création de l’attestation liée
        InfoAttestation::create([
            'id_demande' => $demande->id,
            'nom_complet' => $request->nom_complet,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'ecole' => $request->ecole,
            'numero_table' => $request->numero_table,
            'session' => $request->session,
            'centre' => $request->centre,
            'numero_registre' => $request->numero_registre,
        ]);

        return redirect()->route('demandes.index')->with('success', 'Demande enregistrée avec attestation.');
    }

    public function edit($id)
    {
        $demande = Demande::with('infoAttestation')->findOrFail($id);
        return view('admin.demandes.edit', compact('demande'));
    }

    public function update(Request $request, $id)
    {
        $demande = Demande::findOrFail($id);
        $demande->statut = $request->statut;
        $demande->save();

        return redirect()->route('admin.demandes.index')->with('success', 'Demande mise à jour.');
    }

    public function destroy($id)
    {
        Demande::findOrFail($id)->delete();
        return redirect()->route('demandes.index')->with('success', 'Demande supprimée.');
    }
}