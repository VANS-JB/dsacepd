<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Demande;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = UserNotification::with('user','demande')->latest()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create($demandeId)
    {
        $demande = Demande::with('user')->findOrFail($demandeId);
        return view('admin.notifications.create', compact('demande'));
    }

    /**
     * Envoi de la notification
     *
     * Accepte :
     * - POST /notifications/store avec id_users ou demande_id
     * - ou POST /notifications/{demandeId} (param route)
     */
    public function store(Request $request, $demandeId = null)
    {
        // récupérer l'id de la demande (route ou champ)
        $demandeId = $demandeId ?? $request->input('demande_id') ?? $request->route('demandeId') ?? null;
        $demande = $demandeId ? Demande::find($demandeId) : null;

        // règles de validation
        $rules = ['message' => 'required|string|max:255'];
        if (! $demande && ! $request->filled('id_users')) {
            // si pas de demande liée, on exige id_users
            $rules['id_users'] = 'required|exists:users,id';
        } elseif ($request->filled('id_users')) {
            $rules['id_users'] = 'exists:users,id';
        }

        $request->validate($rules);

        // déterminer l'utilisateur cible
        $userId = null;
        if ($demande) {
            // essayer plusieurs colonnes possibles si votre schema varie
            $userId = $demande->id_users ?? $demande->user_id ?? optional($demande->user)->id;
        }
        if (! $userId) {
            $userId = $request->input('id_users') ?? null;
        }

        if (! $userId || ! User::find($userId)) {
            return back()->withErrors(['id_users' => 'Utilisateur cible introuvable.'])->withInput();
        }

        // préparer les données d'insertion (inclure id_demande si pertinent)
        $data = [
            'id_users' => $userId,
            'message' => $request->message,
            'date_notification' => now(),
        ];
        if ($demande) {
            $data['id_demande'] = $demande->id;
        } elseif ($request->filled('demande_id')) {
            $data['id_demande'] = $request->input('demande_id');
        }

        // créer la notification
        UserNotification::create($data);

        // mettre à jour le statut de la demande si on en a une
        if ($demande) {
            $demande->update(['statut' => 'attestation prête']);
        } elseif (! empty($data['id_demande'])) {
            $d = Demande::find($data['id_demande']);
            if ($d) { $d->update(['statut' => 'attestation prête']); }
        }

        return redirect()->route('notifications.index')->with('success', 'Notification envoyée au demandeur.');
    }

    public function destroy($id)
    {
        UserNotification::findOrFail($id)->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification supprimée.');
    }
}