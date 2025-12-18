<?php

namespace App\Http\Controllers\Demandeur;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Liste des notifications du demandeur connecté
     */
    public function index()
    {
        $notifications = Notification::where('id_users', auth()->id())
                                     ->orderBy('date_notification', 'desc')
                                     ->get();

        // Marquer comme lues
        Notification::where('id_users', auth()->id())->update(['is_read' => true]);

        return view('demandeur.notifications', compact('notifications'));
    }
}