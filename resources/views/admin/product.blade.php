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
                <h2 class="content-title card-title">product</h2>
                <p>You can manage product here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="card mb-4 col-12">
                <div class="card-header">
                    <h4>Create Record</h4>
                </div>
                <div class="card-body">
                    <form id="create_product_record">
                        <input type="hidden" name="cat_id" value="{{ $category_id }}">
                        <input type="hidden" name="sub_cat_id" value="{{ $id }}">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="product_title" class="form-label">product title</label>
                                <input type="text" placeholder="Enter Here" name="product_title"
                                    class="form-control clear_input" id="product_title" />
                                <span id="product_title_error" class="clear_form_error" style="color: red"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="product_price" class="form-label">product price</label>
                                <input type="text" placeholder="Enter Here" name="product_price"
                                    class="form-control clear_input" id="product_price" />
                                <span id="product_price_error" class="clear_form_error" style="color: red"></span>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea class="form-control clear_input" name="description" id="description" rows="3" placeholder="you can add details"></textarea>
                                    <span id="description_error" class="clear_form_error" style="color: red"></span>
                                  </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <div  class="row">
                                    <div class="col-md-4">
                                        <input  id="image_1" data-allowed-file-extensions="jpeg jpg png"
                                            data-max-file-size-preview="1M" name="image_1" class="dropify"
                                            type="file" >
                                        <span class="clear_form_error text-danger" id="image_1_error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input  id="image_2" data-allowed-file-extensions="jpeg jpg png"
                                            data-max-file-size-preview="1M" name="image_2" class="dropify"
                                            type="file" >
                                        <span class="clear_form_error text-danger" id="image_2_error"></span>
                                    </div>
                                    <div class="col-md-4">
                                        <input  id="image_3" data-allowed-file-extensions="jpeg jpg png"
                                            data-max-file-size-preview="1M" name="image_3" class="dropify"
                                            type="file" >
                                        <span class="clear_form_error text-danger" id="image_3_error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="create_record" class="btn custom-button mt-2">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="category_table" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Product Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="update_product_form">

                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                                <div class="form-group">
                                    <label>product title</label>
                                    <input type="text" class="form-control clear_input" name="product_title" id="product_title_edit">
                                    <span id="product_title_edit_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>product price</label>
                                    <input type="text" class="form-control clear_input" name="product_price" id="product_price_edit">
                                    <span id="product_price_edit_error" class="text-danger clear_form_error"></span>
                                </div>
                              
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea class="form-control clear_input" name="description" id="description_edit" rows="3" placeholder="you can add details"></textarea>
                                    <span id="description_edit_error" class="clear_form_error" style="color: red"></span>
                                </div>

                                <div class="div row m-3">
                                    <div class="col-md-6">
                                    <img id="img_1_updated_preview" src="" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="img_1_updated" data-allowed-file-extensions="jpeg jpg png"
                                        data-max-file-size-preview="1M" name="image_1" class="dropify"
                                        type="file" >
                                    <span class="clear_form_error text-danger" id="img_1_updated_error"></span>
                                    </div>
                                </div>

                                <div class="div row m-3">
                                    <div class="col-md-6">
                                    <img id="img_2_updated_preview" src="" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="img_2_updated" data-allowed-file-extensions="jpeg jpg png"
                                        data-max-file-size-preview="1M" name="image_2" class="dropify"
                                        type="file" >
                                    <span class="clear_form_error text-danger" id="img_2_updated_error"></span>
                                    </div>
                                </div>

                                <div class="div row m-3">
                                    <div class="col-md-6">
                                    <img id="img_3_updated_preview" src="" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="img_3_updated" data-allowed-file-extensions="jpeg jpg png"
                                        data-max-file-size-preview="1M" name="image_3" class="dropify"
                                        type="file" >
                                    <span class="clear_form_error text-danger" id="img_3_updated_error"></span>
                                    </div>
                                </div>
                                
                                <div class="row m-3">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="productEdit" required
                                                id="productEdit" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_product_btn" class="btn btn-primary">Save
                                changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}

            <div id="product_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Product Info</h5>
                    </div>
                    <div class="modal-body">
                      <div class="div">
                        <p>product title : <br> <span style="color: black" id="product_title_info"></span></p>
                      </div>
                      <div class="div">
                        <p>product price  : <br> <span style="color: black" id="product_price_info"></span></p>
                      </div>
                      <div class="div">
                        <p>description  : <br> <span style="color: black" id="description_info"></span></p>
                      </div>
                      <div class="div row">
                        <div class="col-md-4">
                        <img id="img_1" src="" alt="">
                        </div>
                        <div class="col-md-4">
                            <img id="img_2" src="" alt="">
                        </div>
                        <div class="col-md-4">
                            <img id="img_3" src="" alt="">
                        </div>
                      </div>
                    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>

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

                    $('.dropify').dropify({
                    messages: {
                    'default': 'Drag and drop a image here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                        }
                    });

                    //  view data on table start 
                    $('#category_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('admin.product.getData') }}",
                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'product_title',
                                name: 'product_title'
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
                        var create_record = $('#create_product_record')[0];
                        var create_record_ajax = new FormData(create_record); // get form data

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
                            data: create_record_ajax,
                            success: function(response) {
                            // Initializing Dropify
                            var drEvent = $('#image_1').dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();

                            var drEvent = $('#image_2').dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();

                            var drEvent = $('#image_3').dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();

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
                            $('#product_title_error').html(error.responseJSON.errors
                                .product_title);
                            $('#product_price_error').html(error.responseJSON.errors
                            .product_price);
                            $('#description_error').html(error.responseJSON.errors
                            .description);
                            $('#image_1_error').html(error.responseJSON.errors
                            .image_1);
                            $('#image_2_error').html(error.responseJSON.errors
                            .image_2);
                            $('#image_3_error').html(error.responseJSON.errors
                            .image_3);
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

                    var drEvent = $('#img_1_updated').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();

                    var drEvent = $('#img_2_updated').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();

                    var drEvent = $('#img_3_updated').dropify();
                    drEvent = drEvent.data('dropify');
                    drEvent.resetPreview();
                    drEvent.clearElement();

                    $.ajax({
                        url: '{{ url('admin/product') }}' + '/' + id + '/info',
                        method: 'GET',
                        success: function(response) {
                            console.log(response)
                            $('#update_id').val(response[0].id);
                            $('#product_title_edit').val(response[0].product_title);
                            $('#product_price_edit').val(response[0].product_price);
                            $('#description_edit').val(response[0].description);
                            $('#img_1_updated_preview').attr('src', '/product_images/'+response[0].name);
                            $('#img_2_updated_preview').attr('src', '/product_images/'+response[1].name);
                            $('#img_3_updated_preview').attr('src', '/product_images/'+response[2].name);
                            $('#edit_category_form').modal('show');
                            //start status of vehicle type 
                            if (response[0].status == 0) {
                                $('#productEdit').bootstrapToggle('off');
                            } else {
                                $('#productEdit').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                $('body').on('click', '.info', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/product') }}' + '/' + id + '/info',
                        method: 'GET',
                        success: function(response) {
                        $('#product_title_info').html(response[0].product_title) 
                        $('#product_price_info').html(response[0].product_price) 
                        $('#description_info').html(response[0].description) 
                        
                        $('#img_1').attr('src', '/product_images/'+response[0].name);
                        $('#img_2').attr('src', '/product_images/'+response[1].name);
                        $('#img_3').attr('src', '/product_images/'+response[2].name);

                        $('#product_modal').modal('show')
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_product_btn').click(function() {
                    document.getElementById("update_product_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var product = $('#update_product_form')[0];
                    var product_ajax = new FormData(product); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.product.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: product_ajax,
                        success: function(response) {
                            $('#edit_category_form').modal('hide');
                            document.getElementById("update_product_btn").disabled = false;

                            if (response.code == "success") {
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
                            document.getElementById("update_product_btn").disabled = false;
                            // display validations in created admin 
                            $('#product_title_edit_error').html(error.responseJSON.errors.product_title);
                            $('#product_price_edit_error').html(error.responseJSON.errors.product_price);
                            $('#description_edit_error').html(error.responseJSON.errors.description);

                            $('#img_1_updated_error').html(error.responseJSON.errors.image_1);
                            $('#img_2_updated_error').html(error.responseJSON.errors.image_2);
                            $('#img_3_updated_error').html(error.responseJSON.errors.image_3);
                        }
                    });
                });
                //    update data end 

            </script>
    </section>
@endsection




























