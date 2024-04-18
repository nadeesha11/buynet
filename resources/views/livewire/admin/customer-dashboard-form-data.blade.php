<form wire:submit.prevent="customerDataUpdate" >
    <div class="row">
        <div class="form-group col-md-6">
            <label>First Name <span class="required">*</span></label>
            <input wire:model="first_name" value="{{ $first_name }}"  class="form-control" type="text" />
            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-6">
            <label>Last Name <span class="required">*</span></label>
            <input wire:model="last_name" value="{{ $last_name }}" type="text" class="form-control" />
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Address Line 1<span class="required">*</span></label>
            <input wire:model="address_line_1" value="{{ $address_line_1 }}"  class="form-control" type="text" />
            @error('address_line_1') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Address Line 2<span class="required">*</span></label>
            <input wire:model="address_line_2" value="{{ $address_line_2 }}" class="form-control" type="text" />
            @error('address_line_2') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Postal Code <span class="required">*</span></label>
            <input wire:model="postal_code" value="{{ $postal_code }}" class="form-control" type="text" />
            @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Phone <span class="required">*</span></label>
            <input wire:model="phone" value="{{ $phone }}" class="form-control" type="text" />
            <span>Ex: 071 xxx xxx xxxx</span><br>
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group col-md-12">
            <label>Email <span class="required">*</span></label>
            <input wire:model="email" value="{{ $email }}" class="form-control" type="email" />
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="payment ml-30">
        <button type="submit" class="btn btn-fill-out btn-block mt-30">Submit<i class="fi-rs-sign-out ml-15"></i></button>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('customer_data_updated_success', () => {
            Swal.fire({
                title: 'Success!',
                text: 'Account details updated.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        });

        Livewire.on('customer_data_updated_error', () => {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });

    });
</script>
