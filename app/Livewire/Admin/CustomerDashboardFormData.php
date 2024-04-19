<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CustomerDashboardFormData extends Component
{
    public $first_name;
    public $last_name;
    public $address_line_1;
    public $address_line_2;
    public $postal_code;
    public $phone;
    public $email;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'address_line_1' => 'required',
        'address_line_2' => 'required',
        'postal_code' => 'required|numeric',
        'phone' => 'required|numeric|digits:10',
        'email' => 'required|email',
    ];

    public function customerDataUpdate(){
        $this->validate();
        try {
            $customerData = session()->get('customer_data');
            $results = DB::table('users')->where('id',$customerData->id)->update([
            'first_name_order' => $this->first_name,
            'last_name_order' => $this->last_name,
            'address_1_order' => $this->address_line_1,
            'address_2_order' => $this->address_line_2,
            'postal_code_order' => $this->postal_code,
            'phone_order' => $this->phone,
            'email_order' => $this->email,
            ]);
            if($results){
            $this->dispatch('customer_data_updated_success');
            }
            else{
             $this->reset();
             $this->dispatch('customer_data_updated_success');
            }

        } catch (\Throwable $th) {
           dd($th->getMessage());
            $this->dispatch('customer_data_updated_error');
        }
       
    }

    public function mount()
    {
        $this->getData();
    }

    public function getData(){
        $customerData = session()->get('customer_data');
        $data = DB::table('users')->where('id',$customerData->id)->first();

        $this->first_name = $data->first_name_order;
        $this->last_name = $data->last_name_order;
        $this->address_line_1 = $data->address_1_order;
        $this->address_line_2 = $data->address_2_order;
        $this->postal_code = $data->postal_code_order;
        $this->phone = $data->phone_order;
        $this->email = $data->email_order;
    }

    public function render()
    {
        $this->getData();
        return view('livewire.admin.customer-dashboard-form-data');
    }
}
