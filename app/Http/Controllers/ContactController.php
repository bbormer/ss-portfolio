<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;
use Illuminate\Validation\Rule;


class ContactController extends Controller
{
    public function show() {
        // echo 'ContactController show';
        return view('contact');
    }

    public function submit(ContactRequest $request) {
        $mail_status = 1;
        try {
            Mail::to('contact@satomisuzuki.info')->send(new ContactMail($request->name, $request->email, $request->content));
        } catch (Exception $e) {
            $mail_status = 0;
        }
        // if(Mail::flushMacros()) {$msg = "Message send failure";}
        // return to_route('contact.submit')->with('status', "Message has been sent successfully");
        // return redirect('/contact')->with('status', "Message has been sent successfully");
        if($mail_status == 1) {
            // dd($request);
            return redirect()->route('contact.submit')->with(['status' => $mail_status]);
        } else {
            // dd($mail_status);
            return redirect()->route('contact.submit')->with(['status' => $mail_status])->withInput();
        }
        // return redirect()->route('contact.submit')->with(['status' => $msg])->withInput();
        // return redirect()->route('contact.submit')->withInput();
    }

    public function validateForm(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'email' => 'required | email:filter,dns,rfc',
            'content' => 'required'
        ]);

        // return route('contact.submit');

        $mail_status = 1;
        try {
            Mail::to('contact@satomisuzuki.info')->send(new ContactMail($request->name, $request->email, $request->content));
        } catch (Exception $e) {
            $mail_status = 0;
        }
        // if(Mail::flushMacros()) {$msg = "Message send failure";}
        // return to_route('contact.submit')->with('status', "Message has been sent successfully");
        // return redirect('/contact')->with('status', "Message has been sent successfully");
        if($mail_status == 1) {
            // dd($request);
            return redirect()->route('contact.show')->with(['status' => $mail_status]);
        } else {
            // dd($mail_status);
            return redirect()->route('contact.show')->with(['status' => $mail_status])->withInput();
        }
    }
}
