<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserNotification;

class NotificationController extends Controller
{
    /**
     * Liste des notifications envoyées
     */
    public function index()
    {
        $notifications = UserNotification::with('user')->latest()->paginate(10);
        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Formulaire pour notifier un demandeur
     */
    public function create($userId)
    {
        $user = User::findOrFail($userId);
        return view('admin.notifications.create', compact('user'));
    }

    /**
     * Envoi de la notification
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_users' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Notification::create([
            'id_users' => $request->id_users,
            'message' => $request->message,
            'date_notification' => now(),
        ]);

        return redirect()->route('notifications.index')->with('success', 'Notification envoyée au demandeur.');
    }
}