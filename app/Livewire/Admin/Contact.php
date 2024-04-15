<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;


class Contact extends Component
{
    public $name;
    public $email;
    public $telephone;
    public $subject;
    public $description;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'telephone' => 'required',
        'subject' => 'required',
        'description' => 'required',
    ];

    public function submitForm()
    {
        $this->validate();

        try {
          
            $data = [
                'name' => (string) $this->name,
                'email' => (string) $this->email,
                'telephone' => (string) $this->telephone,
                'subject' => (string) $this->subject,
                'description' => (string) $this->description,
            ]; 

            // Send mail
           $result = Mail::send('contact_mail', $data, function ($message) {
                $message->from('jayathilaka221b@gmail.com', 'buynet');
                $message->to('jayathilaka221b@gmail.com', 'buynet')->subject('Contact');
            });
            
            if( $result ){
                $this->dispatch('contact_success');
            }
            else{
                $this->dispatch('contact_failed');
            }
            $this->reset();
        } catch (\Throwable $th) {
            dd($th->getMessage());
            // $this->dispatch('contact_failed');
        }
       

        
    }
    public function render()
    {
        return view('livewire.admin.contact');
    }
}
