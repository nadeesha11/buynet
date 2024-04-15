<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Checkout extends Component
{
    public $fname;
    public $lname;
    public $address_1;
    public $address_2;
    public $postal;
    public $phone;
    public $email;
    public $additional_info;

    protected $rules = [
        'fname' => 'required',
        'lname' => 'required',
        'address_1' => 'required',
        'address_2' => 'required',
        'postal' => 'required',
        'phone' => 'required',
        'email' => 'required|email',
        'additional_info' => 'required',
    ];

    public function submitForm(){
      $this->validate();
    }
    public function render()
    {
        return view('livewire.admin.checkout');
    }
}
