<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

use App\Models\ContactMessage; 

use App\Mail\ContactMessageReceived;


class ContactMessageController extends Controller
{

    

    public function submitForm(Request $request): RedirectResponse
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'category' => 'required|string|in:faq_request,other',    ]);

    // Store the contact message in the database
    $contactMessage = ContactMessage::create($request->all());
   

    // Send the email to the admin
    Mail::to('admin@example.com')->send(new ContactMessageReceived($contactMessage));

   

    return redirect()->route('contactForm')->with('status', 'Message sent successfully!');
}


    public function showForm(): View
    {
        return view('content.contactform');
    }

    public function showMessage($id): View
    {
        $message = ContactMessage::findOrFail($id);
        return view('admin.contactMessages.answerMessage', compact('message'));
    }

   
}
