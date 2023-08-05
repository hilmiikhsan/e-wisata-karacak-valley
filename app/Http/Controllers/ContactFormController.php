<?php

namespace App\Http\Controllers;

use App\ContactForm;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_form = ContactForm::all();
        $data = [
            'title' => 'E-Wisata | Pesan Form Kontak',
            'contact_form' => $contact_form
        ];

        return view('dashboard.contact_form.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string'],
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191'],
            'subject' => ['required', 'string', 'max:191']
        ]);

        $contact_form = new ContactForm();
        $contact_form->message = $request->message;
        $contact_form->name = $request->name;
        $contact_form->email = $request->email;
        $contact_form->subject = $request->subject;
        $contact_form->save();

        return redirect()->back()->with('success', 'Terimakasih, pesan anda berhasil terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContactForm::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
