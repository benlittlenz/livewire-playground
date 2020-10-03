<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;

class ContactForm extends Component
{

    public $name;
    public $email;
    public $phone;
    public $message;
    public $successMessage;

    public function submitForm()
    {
        // $contact = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'phone' => 'required',
        //     'message' => 'required',
        // ]);

        $contact['name'] = $this->name;
        $contact['email'] = $this->email;
        $contact['phone'] = $this->phone;
        $contact['message'] = $this->message;

        Mail::to('andre@andre.com')->send(new ContactFormMailable($contact));

        $this->successMessage = 'We received your message successfully and will get back to you shortly!';

        $this->resetForm();

        //session()->flash('success_message', );
    }

    private function resetForm()
    {
        $this->email = '';
        $this->phone = '';
        $this->message = '';
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
