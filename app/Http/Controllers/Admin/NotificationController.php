<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserNotification;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request, $demandeId)
{
    $request->validate([
        'message' => 'required|string|max:255',
    ]);

    $demande = Demande::with('user')->findOrFail($demandeId);

    // Créer la notification
    UserNotification::create([
        'id_users' => $demande->user->id,
        'id_demande' => $demande->id,
        'message' => $request->message,
        'date_notification' => now(),
    ]);

    // ⚡ Pas besoin de mettre à jour le statut ici

    return redirect()->route('notifications.index')
                     ->with('success', 'Notification envoyée au demandeur.');
}
    public function destroy($id)
    {
        UserNotification::findOrFail($id)->delete();
        return redirect()->route('notifications.index')->with('success', 'Notification supprimée.');
    }
}