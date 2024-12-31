<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactUpdateRequest;
use App\Http\Requests\Contact\ContactStoreRequest;
use App\Models\Contact;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ContactController extends Controller
{
    use ApiResponse;



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(200, 'Contacts returned successfully.', Contact::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContactStoreRequest $request)
    {
        $contact = Contact::create($request->validated());
        return $this->success(200, 'Contact created successfully.', $contact);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return $this->success(200, 'Contact returned successfully.', $contact);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // return view();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactUpdateRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return $this->success(200, 'Contact updated successfully.', $contact);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $this->success(200, 'This message is deleted successfully.');
    }
}
