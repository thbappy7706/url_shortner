@extends('admin.layouts.app')
@section('pageTitle', $pageTitle)

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label">Contacts List</h3>
                        </div>
                        <div class="card-toolbar">

                            <!--begin::Button-->
                                <a href="{{route('admin.contacts.create')}}" class="btn btn-success">
                                    <i class="flaticon2-plus-1"></i> Add New
                                </a>
                                <!--end::Button-->

                        </div>
                    </div>


                    <div class="card-body">
                        <div class="m-section__content">
                            <form id="searchForm" role="form" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" placeholder="Search Name">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" placeholder="Search Email">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone_no" placeholder="Search Phone No">
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                                            <div class="form-group">
                                                <select class="form-control" name="isFavorite">
                                                    <option value="">Search By Favorite Or Not</option>
                                                    <option value="1">Favorite</option>
                                                    <option value="0">General</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="clearfix">
                                            <hr/>
                                        </div>

                                        <div class="col-md-12 text">
                                            <div class="text-center search-action-btn">
                                                <button class="btn btn-info m-btn m-btn--icon">
                                                    <i class="fa fa-search"></i> Search
                                                </button>
                                                <button type="reset" class="btn btn-primary reset"><i
                                                        class="fas fa-sync-alt search-reset"></i> Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                </div>
                            </form>

                        </div>


                        <!--begin: Datatable-->
                    @include('admin.common.datatable')
                    <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>

    <!-- delete contact modal start-->
    <div class="modal fade" id="contact-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Delete Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-3">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group  m-form__group mb-0">
                                <input type="hidden" name="id" id="contactId">
                                <h5 class="text-danger mb-0">Are you Sure want to delete ?</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class= "modal-footer">
                    {{-- <button type="submit" class="btn btn-success mr-3"><i class="flaticon2-paperplane"></i>Save</button>
                     <button type="reset" class="btn btn-danger"><i class="flaticon-close"></i>Cancel</button>--}}

                    <button type="button" class="btn btn-danger mr-3" data-dismiss="modal"><i class="flaticon-close"></i> Close</button>
                    <button type="button" class="btn btn-success" id="delete-contact-btn"><i class="flaticon2-paperplane"></i> Submit</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@once
    @push('scripts')
        <script src="{{asset('assets/global/datatables/datatables.bundle.js')}}"></script>

        <script>
            $(document).on('click', '.btn-delete', function (e) {
                var contactId = $(this).data('contact-id')
                $('#contactId').val(contactId);
                $('#contact-delete-modal').modal('show');
            });

            $('#delete-contact-btn').click(function (e) {
                e.preventDefault();
                var contactId = $('#contactId').val();
                $.ajax({
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: baseUrl+ 'admin/contacts/'+contactId,
                    dataType: 'JSON',
                    data: {
                        'contactId': contactId,
                    },
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#contact-delete-modal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: "Item Deleted successfully",
                            type: 'success',
                            showConfirmButton: true,
                            timer: 9000
                        });
                        location.reload();

                    },
                    error: function (xhr) {
                        $('#contact-delete-modal').modal('hide');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "You have no access to delete",
                            type: 'error',
                            showConfirmButton: false,
                            //confirmButtonText: 'Yes'
                            timer: 5000
                        });
                        location.reload();
                        console.log(xhr.responseText);
                    }
                });
            })
        </script>
    @endpush
@endonce
