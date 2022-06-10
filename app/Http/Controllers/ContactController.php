<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Rules\InvalidEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = auth()->user()->contacts;
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'name' => 'required',
            'email' => ['required','email','exists:users',
            Rule::notIn([auth()->user()->email]),
            new InvalidEmail()
            ]
    ]);
        $user = User::where('email', $request->email)->first();

        $contact = Contact::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
            'contact_id' => $user->id,
        ]);
        session()->flash('flash.banner', 'Contact created successfully');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //Validation
        $request->validate([
            'name' => 'required',
            'email' => ['required','email','exists:users',
            Rule::notIn([auth()->user()->email]),
            new InvalidEmail($contact->user->email)
            ]
    ]);
        $user = User::where('email', $request->email)->first();

        $contact->update([
            'name' => $request->name,
            'contact_id' => $user->id,
        ]);

        session()->flash('flash.banner', 'Contact edited successfully');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('contacts.edit', $contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        session()->flash('flash.banner', 'Contact deleted successfully');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('contacts.index');
    }
}
