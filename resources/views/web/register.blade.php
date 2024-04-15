@extends('layout.webLayout')
@section('content')
<style>
    .card-login {
        padding: 10px !important;
    }
    #vendor_register_form input{
        border : 0.5px solid green !important;
    }
</style>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="#">Register</a>
            </div>
        </div>
    </div>
    <div class="page-content  pb-150">
        <div class="container">
            <div class="row">
                <div>
                    <div>
                        <div>
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div style="margin-top: 20px !important;" class="heading_s1 text-center">
                                        <h1 class="mb-3">Create an Account</h1>
                                        <p class="mb-30">Already have an account? <a
                                                href="{{ route('web.login') }}">Login</a></p>
                                    </div>

                                    <div class="row">

                                        <div class="d-none d-md-block col-lg-2 col-md-2"></div>

                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <form id="register_form" class="card-login">
                                                <div class="form-group">
                                                    <input class="clear_input" type="text" name="username"
                                                        placeholder="Username" />
                                                    <span id="username_error"
                                                        class="text-danger clear_form_error"></span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="clear_input" name="email"
                                                        placeholder="Email" />
                                                    <span id="email_error" class="text-danger clear_form_error"></span>
                                                </div>
                                                <div class="form-group">
                                                  <div class="relative">
                                                    <input type="password" class="clear_input pr-10" name="password" id="password" placeholder="Password" />
                                                    <span class="toggle-icon" onclick="togglePassword('password')">
                                                        <span id="hide_password"> Show</span>
                                                        <i class="absolute top-1/2 transform -translate-y-1/2 right-3 cursor-pointer fas fa-eye"></i>
                                                    </span>
                                                </div>

                                                    <span id="password_error"
                                                        class="text-danger clear_form_error"></span> <br>
                                                    <span class="text-success">password should contain minimum
                                                        6 length </span>
                                                </div>

                                                <div class="form-group text-center">
                                                    <a class="btn btn-danger" id="submit">Create</a>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="d-none d-md-block col-lg-2 col-md-2"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
 function togglePassword(inputId) {
    const passwordInput = document.getElementById(inputId);
    const hidePasswordSpan = document.getElementById('hide_password');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        hidePasswordSpan.textContent = ' Hide';
    } else {
        passwordInput.type = 'password';
        hidePasswordSpan.textContent = ' Show';
    }
}

 function togglePassword2(inputId, textId) {
    const passwordInput = document.getElementById(inputId);
    const hideConfirmPasswordSpan = document.getElementById(textId);

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        hideConfirmPasswordSpan.textContent = ' Hide';
    } else {
        passwordInput.type = 'password';
        hideConfirmPasswordSpan.textContent = ' Show';
    }
}
</script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //ajax setup


        //  need to create ajax create 
        $('#submit').click(function() {

            document.getElementById("submit").disabled = true; //enable button after click it
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#register_form')[0];
            var form_ajax = new FormData(form); // get form data
            console.log(form_ajax);
            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            // ajax post start 
            $.ajax({
                url: "{{ route('web.customer.create') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_ajax,
                success: function(response) {
                    document.getElementById("submit").disabled =
                        false; //enable button after click it

                    if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                    } else {
                        window.location.href = "{{ route('web.dashboard') }}";
                    }

                    $('.clear_input').val('');
                    $('.clear_form_error').html('');
                    //   Swal.close();
                },

                error: function(error) {
                    // display validations in created slider 
                    $('#username_error').html(error.responseJSON.errors.username);
                    $('#email_error').html(error.responseJSON.errors.email);
                    $('#password_error').html(error.responseJSON.errors.password);
                    document.getElementById("submit").disabled =
                        false; //enable button after click it
                    Swal.close();
                }
            });
        });


    });
</script> 
@endsection