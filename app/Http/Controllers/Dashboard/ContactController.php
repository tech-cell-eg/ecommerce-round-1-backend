<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.contacts.reply', compact('contact'));
    }

    // Handle the reply submission
    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $contact = Contact::findOrFail($id);
        Mail::to($contact->email)->send(new \App\Mail\ContactReply($contact, $request->reply));

        return redirect()->route('admin.contacts.index')->with('success', 'Reply sent successfully.');
    }
}
