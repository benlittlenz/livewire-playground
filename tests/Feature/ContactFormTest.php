<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use App\Http\Livewire\ContactForm;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function main_page_contains_contact_form_component()
    {
        $this->get('/')
            ->assertSeeLivewire('contact-form');
    }

    /** @test */
    public function contact_form_sends_out_email()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'bob')
            ->set('email', 'bob2@mail.com')
            ->set('phone', '12345')
            ->set('message', 'testing')
            ->call('submitForm')
            ->assertSee('We received your message successfully and will get back to you shortly!');

        Mail::assertSent(function (ContactFormMailable $mail) {
            $mail->build();

            return $mail->hasTo('bob@mail.com') &&
                $mail->hasFrom('bob2@mail.com') &&
                $mail->subject === 'Contact Form Submission';
        });
    }

    /** @test */
    public function contact_name_field_is_required()
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'bob2@mail.com')
            ->set('phone', '12345')
            ->set('message', 'testing')
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }
}
