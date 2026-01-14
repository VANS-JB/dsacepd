<?php

namespace App\Http\Controllers;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index()
    {
        $messages = \App\Models\Contact::latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

     public function showForm()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // ✅ Enregistrement en base
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Votre message a été enregistré et envoyé avec succès.');
    }

}
