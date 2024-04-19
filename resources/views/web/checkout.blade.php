@extends('layout.webLayout')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-7">
           
        <div class="row">
            <h4 class="mb-30">Checkout Details</h4>
            <form action="{{ route('web.payment') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6">
                        <input type="text" name="fname" value="{{ old('fname') ?? (session()->has('customer_data') ? session('customer_data')->first_name_order : '') }}" placeholder="First name *">
                        @error('fname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" name="lname" value="{{ old('lname') ?? (session()->has('customer_data') ? session('customer_data')->last_name_order : '') }}" placeholder="Last name *">
                        @error('lname')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-6">
                        <input type="text" name="address_1" value="{{ old('address_1') ?? (session()->has('customer_data') ? session('customer_data')->address_1_order : '') }}" placeholder="Address 1 *">
                        @error('address_1')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" name="address_2" value="{{ old('address_2') ?? (session()->has('customer_data') ? session('customer_data')->address_2_order : '') }}" placeholder="Address 2 *">
                        @error('address_2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            
                <div class="row">
                    <div class="form-group col-lg-6">
                         <input type="text" name="postal" value="{{ old('postal') ?? (session()->has('customer_data') ? session('customer_data')->postal_code_order : '') }}" placeholder="enter postal*">
                        @error('postal')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <input type="text" name="phone" value="{{ old('phone') ?? (session()->has('customer_data') ? session('customer_data')->phone_order : '') }}" placeholder="enter phone*">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-6">
                     <input type="text" name="email" value="{{ old('email') ?? (session()->has('customer_data') ? session('customer_data')->email_order : '') }}" placeholder="enter email*">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-lg-6">
                    <select name="district" style="height: 65px !important;" class="form-select">
                        <option value="">Please select district</option>
                        <option value="Ampara">Ampara</option>
                        <option value="Anuradhapura">Anuradhapura</option>
                        <option value="Badulla">Badulla</option>
                        <option value="Batticaloa">Batticaloa</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Galle">Galle</option>
                        <option value="Gampaha">Gampaha</option>
                        <option value="Hambantota">Hambantota</option>
                        <option value="Jaffna">Jaffna</option>
                        <option value="Kalutara">Kalutara</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kegalle">Kegalle</option>
                        <option value="Kilinochchi">Kilinochchi</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <option value="Mannar">Mannar</option>
                        <option value="Matale">Matale</option>
                        <option value="Matara">Matara</option>
                        <option value="Monaragala">Monaragala</option>
                        <option value="Mullaitivu">Mullaitivu</option>
                        <option value="Nuwara Eliya">Nuwara Eliya</option>
                        <option value="Polonnaruwa">Polonnaruwa</option>
                        <option value="Puttalam">Puttalam</option>
                        <option value="Ratnapura">Ratnapura</option>
                        <option value="Trincomalee">Trincomalee</option>
                        <option value="Vavuniya">Vavuniya</option>
                    </select>
                    
                    @error('district')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                </div>
                <div class="form-group mb-30">
                    <textarea rows="5" name="additional_info"  placeholder="Additional information">{{ old('additional_info') }}</textarea>
                    @error('additional_info')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="payment ml-30">
                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                </div>
            </form>
        </div>
               
            </div>
           
            @livewire('Admin.SummersizeCheckoutDetails')
        </div>
    </div>
</main>
@endsection