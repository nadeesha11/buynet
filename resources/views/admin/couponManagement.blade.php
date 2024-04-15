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
                <h2 class="content-title card-title">Coupon</h2>
                <p>You can manage coupon here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="card mb-4 col-3">
                <div class="card-header">
                    <h4>Create Record</h4>
                </div>
                <div class="card-body">
                    <form id="create_coupon_record">
                        <div class="mb-4">
                            <label for="coupon_count" class="form-label">Count</label>
                            <input type="text" placeholder="Enter Here" name="coupon_count"
                                class="form-control clear_input" id="coupon_count" />
                            <span id="coupon_count_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="expire_date" class="form-label">Expire Date</label>
                            <input type="datetime-local" placeholder="Enter Here" name="expire_date"
                                class="form-control clear_input" id="expire_date" />
                            <span id="expire_date_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="discount_rate" class="form-label">Discount rate</label>
                            <input type="text" placeholder="Enter Here" name="discount_rate"
                                class="form-control clear_input" id="discount_rate" />
                            <span id="discount_rate_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="product" class="form-label">Product </label>
                            <select class="form-select" name="product" aria-label="Default select example">
                                <option value="" selected>Open this select menu</option>
                                @foreach ($data as $item)
                                <option value="{{ $item->id }}">{{ $item->product_title }}</option>  
                                @endforeach
                              </select>
                            <span id="product_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <button id="create_record" class="btn custom-button">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="category_table" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Coupon</th>
                                            <th class="align-middle" scope="col">Product</th>
                                            <th class="align-middle" scope="col">Discount(%)</th>
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
            <div class="modal fade" id="edit_category_form" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Coupon Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="update_category_form">

                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                                <div class="form-group">
                                    <label>discount </label>
                                    <input type="text" class="form-control clear_input" name="discount" id="edit_discount">
                                    <span id="discount_edit_error" class="text-danger clear_form_error"></span>
                                </div>

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="status" required
                                                id="statusEdit" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                          
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_category_btn" class="btn btn-primary">Save
                                changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}

            <!-- card end// -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
                integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
                integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup

                    //  view data on table start 
                    $('#category_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.coupon.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'coupon',
                                name: 'coupon'
                            },
                            {
                                data: 'product_title',
                                name: 'product_title'
                            },
                            {
                                data: 'discount',
                                name: 'discount'
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


                    //  create project start 
                    $('#create_record').click(function() {
                        document.getElementById("create_record").disabled = true; //enable button after click it
                        $('.clear_form_error').html('');

                        // to get csrf
                        var create_coupon_record = $('#create_coupon_record')[0];
                        var create_coupon_record_ajax = new FormData(create_coupon_record); // get form data

                        Swal.fire({
                            title: 'Please wait...',
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // ajax post start 
                        $.ajax({
                            url: "{{ route('admin.product.create') }}",
                            method: "POST",
                            processData: false,
                            contentType: false,
                            data: create_coupon_record_ajax,
                            success: function(response) {

                                if (response.code == "success") {
                                    Swal.fire({
                                        title: 'Success!',
                                        icon: 'success',
                                        text: response.msg,
                                        confirmButtonText: 'OK'
                                    })
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.msg,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    }) //display error msg
                                }

                                $('.clear_input').val('');
                                $('.clear_form_error').html('');
                                //   Swal.close(); // Close the SweetAlert
                                $('#category_table').DataTable().ajax.reload();

                            },

                            error: function(error) {
                                Swal.close(); // Close the SweetAlert
                                // display validations in created slider 
                                $('#coupon_count_error').html(error.responseJSON.errors
                                    .coupon_count);
                                $('#product_error').html(error.responseJSON.errors
                                .product);
                                $('#expire_date_error').html(error.responseJSON.errors
                                .expire_date);
                                $('#discount_rate_error').html(error.responseJSON.errors
                                .discount_rate);
                             
                                document.getElementById("create_record").disabled =
                                    false; //enable button after click it
                            }
                        });
                    });
                    //create slider end
                });

                $('body').on('click', '.edit', function() {
                    $('.clear_form_error').html('');
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/product') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {
                            console.log(response)
                            $('#update_id').val(response.id);
                            $('#edit_discount').val(response.discount);
                            $('#edit_category_form').modal('show');
                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#statusEdit').bootstrapToggle('off');
                            } else {
                                $('#statusEdit').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_category_btn').click(function() {
                    document.getElementById("update_category_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var category = $('#update_category_form')[0];
                    var category_ajax = new FormData(category); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.product.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: category_ajax,
                        success: function(response) {
                            $('#edit_category_form').modal('hide');
                            document.getElementById("update_category_btn").disabled = false;

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
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.clear_form_error').html('');
                            $('#category_table').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_category_btn").disabled = false;
                            // display validations in created admin 
                            $('#discount_edit_error').html(error.responseJSON.errors.discount);
                        }
                    });
                });
                //    update data end 

            </script>
    </section>
@endsection






























