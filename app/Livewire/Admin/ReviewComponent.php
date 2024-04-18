<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReviewComponent extends Component
{
    public $comment;
    public $name;
    public $email;
    public $website;
    public $pro_id;

    public function submitReview()
    {
        // Validate form fields
        $this->validate([
            'comment' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'nullable|url',
        ]);

        try {
            $result = DB::table('review')->insert([
                'name' => $this->name,
                'email' => $this->email,
                'website' => $this->website,
                'product_id' => $this->pro_id,
                'review' => $this->comment,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 1,
            ]);

            if($result){
                $this->reset(['comment', 'name', 'email', 'website']);
                $this->dispatch('reviewAdded_success');
               
            }
            else{
                $this->reset(['comment', 'name', 'email', 'website']);
                $this->dispatch('reviewAdded_success');
                
            }
          
        } catch (\Throwable $th) {
            $this->dispatch('reviewAdded_fail');
        }
   

    }

    public function mount($pro_id)
    {
       
        $this->pro_id = $pro_id;

    }

    public function render()
    {
        return view('livewire.admin.review-component');
    }
}
