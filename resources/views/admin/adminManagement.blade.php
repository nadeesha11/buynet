@extends('layout.layout')
@section('section')
    <style>
        /* Custom button style */
        .custom-button {
            background-color: #0e920e;
            /* Green background color */
            color: #FFFFFF;
            /* White text color */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Padding around the text */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s ease;
            /* Transition for click effect */
        }

        /* Click effect */
        .custom-button:hover {
            background-color: #6fda6f;
            /* Darker green background color on hover */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Admin Management</h2>
                <p>You can manage admins here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">

        <div class="col-4">
                <div class="card mb-4">
                    <div class="card-body">
                     <form id="create_admin_form">
                      <div class="form-group m-2">
                        <input type="text" class="form-control clear_input" name="name" id="name" placeholder="Enter Username">
                        <span id="username_error" class="error_clear text-danger"></span>
                      </div>
                        <div class="form-group m-2">
                        <input type="email" class="form-control clear_input" name="email" id="email" placeholder="Enter Email">
                         <span id="email_error" class="error_clear text-danger"></span>
                      </div>
                      <div class="form-group m-2">
                        <input type="password" class="form-control clear_input" id="password" name="password" placeholder="Password">
                         <span id="password_error" class="error_clear text-danger"></span><br>
                         <small  class="form-text ">Password contain minimun 6 char, with at least one lowercase,uppercase,and number</small>
                      </div>
                       
                       <div class="form-group m-2">
                    
                        <input type="password" class="form-control clear_input" id="password_repeat" name="password_confirmation" placeholder="Repeat Password">
                         <span id="password_repeat_error" class="error_clear text-danger"></span>
                        
                      </div>
             
                      <button type="button" id="create_admin_btn" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="admin_list" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Email</th>
                                            <th class="align-middle" scope="col">Position</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- table-responsive end// -->
                    </div>
                </div>
            </div>

            {{-- modal start  --}}
            <div class="modal fade" id="edit_admin_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Admin Status</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="admin_edit_form">

                                <input type="hidden" class="form-control " name="id" id="update_id">

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="status" required
                                                id="edit_status" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                          
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_admin_data_btn" class="btn btn-primary">Save
                                changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}
            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup

                    //  view data on table start 
                    $('#admin_list').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.adminManagement.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'position',
                                name: 'position'
                            },

                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });


                });

                $('body').on('click', '.edit', function() {

                    var id = $(this).data('id');
                    $.ajax({
             
                        url: '{{ url('/admin/adminManagement') }}' + '/' + id + '/getData',
                        method: 'GET',
                        success: function(response) {

                            $('#update_id').val(response.id);
                            $('#edit_admin_modal').modal('show');

                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#edit_status').bootstrapToggle('off');
                            } else {
                                $('#edit_status').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#create_admin_btn').click(function() {
                    document.getElementById("create_admin_btn").disabled = true;
                    $('.error_clear').html('');

                    // to get csrf
                    var create_admin_form = $('#create_admin_form')[0];
                    var create_admin_form_ajax = new FormData(create_admin_form); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.adminManagement.create') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: create_admin_form_ajax,
                        success: function(response) {
                           
                            document.getElementById("create_admin_btn").disabled = false;
                         
                            if (response.code == "true") {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            if (response.code == "false") {
                                Swal.fire({
                                    title: 'Error!',
                                    icon: 'info',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.error_clear').html('');
                            $('#admin_list').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("create_admin_btn").disabled = false;
                            // display validations in created admin 
                            $('#username_error').html(error.responseJSON.errors
                                .name);
                            $('#email_error').html(error.responseJSON.errors
                                .email);
                            $('#password_error').html(error.responseJSON.errors
                                .password);
                            $('#password_repeat_error').html(error.responseJSON.errors
                                .password_confirmation);
                                
                        }
                    });
                });
                //    update data end 
                
                
                      //    update data start   
                $('#update_admin_data_btn').click(function() {
                    document.getElementById("update_admin_data_btn").disabled = true;
                    $('.error_clear').html('');

                    // to get csrf
                    var admin_edit_form = $('#admin_edit_form')[0];
                    var admin_edit_form_ajax = new FormData(admin_edit_form); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.adminManagement.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: admin_edit_form_ajax,
                        success: function(response) {
                          $('#edit_admin_modal').modal('hide');
                            document.getElementById("update_admin_data_btn").disabled = false;
                         
                            if (response.code == "true") {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            if (response.code == "false") {
                                Swal.fire({
                                    title: 'Error!',
                                    icon: 'info',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.error_clear').html('');
                            $('#admin_list').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_admin_data_btn").disabled = false;
                            // display validations in created admin 
                            $('#username_error').html(error.responseJSON.errors
                                .name);
                       
                        }
                    });
                });
                //    update data end 

            </script>
    </section>
@endsection









