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
                <h2 class="content-title card-title">Order</h2>
                <p>You can manage order here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="category_table" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Total($)</th>
                                            <th class="align-middle" scope="col">Email</th>
                                            <th class="align-middle" scope="col">Contact</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">User</th>
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
            <div class="modal fade" id="edit_order_form" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Order Status</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form  action="{{ route('admin.order.statusChange') }}" method="POST">
                                @csrf
                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                              
                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <select name="status" id="statusChange" class="form-select" aria-label="Default select example">
                                          
                                            <option value="0">Order Placed</option>
                                            <option value="1">Order Packed</option>
                                            <option value="2">Order Shipped</option>
                                            <option value="3">Order Deliverd</option>
                                          </select>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit"  class="btn btn-primary">Save
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
                        ajax: '{!! route('admin.order.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'total',
                                name: 'total'
                            },
                            {
                                data: 'email',
                                name: 'email'
                            },
                            {
                                data: 'phone',
                                name: 'phone'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: null,
                                render: function(data, type, row) {
                                    // Concatenate fname and lname
                                    return data.fname + ' ' + data.lname;
                                }
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });

                });

                $('body').on('click', '.info', function() {
                    var id = $(this).data('id');
                    window.location.href = "{{ url('admin/order') }}" + "/" + id + "/info";
                    // ajax code end
                });

                $('body').on('click', '.edit', function() {
                    $('.clear_form_error').html('');
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/order') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {
                            console.log(response)
                            $('#update_id').val(response.id);   
                            $('#statusChange').val(response.status);                       
                            $('#edit_order_form').modal('show'); 
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

           

            </script>
    </section>
@endsection











































