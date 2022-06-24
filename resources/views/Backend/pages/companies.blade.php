@extends('Backend.layouts.app')


@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @can('company-create')
        @include('Backend.layouts.partials.breadcumb', [
            'data' => ['Organization'],
            'button' => [
                'display' => true,
                'link' => 'company.create',
                'parameters' => null,
                'text' => 'Add New Organization',
                'modalId',
            ],
            'isModal' => true,
            'modalId' => 'add_modal',
            'id' => 'add_model_id',
        ])
    @endcan


    <div class="container-fluid">
        <div class="card white-box">
            <div class="card white-box">
                <div class="card-body">

                    <div class="">
                        <h3 class="text-themecolor">{{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <hr>
                    <form class="m-t-20" action="{{ route('company.index') }}" autocomplete="off" id="frmUserList">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Name</h5>
                                    <div class="controls">
                                        <input type="text" name="name" value="{{ Request::get('name') }}" id="name"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Email</h5>
                                    <div class="controls">
                                        <input type="text" name="email" value="{{ Request::get('email') }}" id="name"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>Status</h5>
                                    <div class="controls">
                                        <select class=" form-control" name="status">
                                            <option value="" {{ $per_page == 'All' ? 'selected' : '' }}>
                                                All
                                            </option>
                                            <option value="rejected" {{ $per_page == 'rejected' ? 'selected' : '' }}>
                                                rejected
                                            </option>
                                            <option value="pending" {{ $per_page == 'pending' ? 'selected' : '' }}>pending
                                            </option>
                                            <option value="accepted" {{ $per_page == 'accepted' ? 'selected' : '' }}>
                                                accepted
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h5>Select Per Page</h5>
                                    <div class="controls">
                                        <select class=" form-control" id="per_page" name="per_page">
                                            <option value="12" {{ $per_page == 12 ? 'selected' : '' }}>12 Per Page
                                            </option>
                                            <option value="24" {{ $per_page == 24 ? 'selected' : '' }}>24 Per Page
                                            </option>
                                            <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50 Per Page
                                            </option>
                                            <option value="100" {{ $per_page == 100 ? 'selected' : '' }}>100 Per Page
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <h5>&nbsp;</h5>
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary zoomer">Search <i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>

                    </form>

                    @include('Backend.layouts.message')

                    <!-- <h5 class="card-subtitle">Swipe Mode, ModeSwitch, Minimap, Sortable, SortableSwitch</h5> -->
                    <div class="table-responsive m-t-10">
                        <table class="tablesaw table-bordered table-hover table no-wrap" data-tablesaw-mode="swipe"
                            data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
                            data-tablesaw-mode-switch>
                            <thead class="text-center">
                                <tr class="text-center-last">
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"
                                        class="border">
                                        Sr #
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2"
                                        class="border">
                                        Name
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2"
                                        class="border">
                                        Picture
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3"
                                        class="border">
                                        Email
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3"
                                        class="border">
                                        Contact
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                        class="border">
                                        Status
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5"
                                        class="border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center-last">
                                @if (isset($companies) && count($companies) > 0)
                                    @foreach ($companies as $k => $company)
                                        <tr>
                                            <td>{{ ++$k + ($companies->currentPage() - 1) * $per_page }}</td>
                                            <td>{{ $company->User->name }}</td>
                                            <td><img src="{{ asset($company->profile_pic) }}" alt="" width="50"></td>
                                            <td>{{ $company->User->email }}</td>
                                            <td>{{ $company->contact_no }}</td>
                                            <td>
                                                <span>
                                                    <label
                                                        class="badge badge-{{ $company->status }}">{{ $company->status }}</label>

                                                </span>

                                            </td>
                                            <td class="text-nowrap" align="center">
                                                @can('company-edit')
                                                    <a href="{{ route('company.edit', $company->id) }}"
                                                        class="btn btn-success zoomer edit"
                                                        data-update="{{ route('company.update', $company->id) }}"
                                                        style="padding:5px 5px;">
                                                        <i class="fa fa-edit text-white m-r-10"></i>
                                                    </a>
                                                @endcan


                                                <a href="{{ route('company.show', $company->id) }}"
                                                    class="btn btn-warning zoomer view" style="padding:5px 5px;">
                                                    <i class="fa fa-eye text-white m-r-10"></i>
                                                </a>

                                                @can('company-delete')
                                                    <a href="" class="btn btn-danger" data-toggle="tooltip"
                                                        data-original-title="Delete"
                                                        onclick="event.preventDefault();  (confirm('Are you sure you want to delete this company? Each and Every record of this company will be deleted from protal.')) ? document.getElementById('delete-form-{{ $company->id }}').submit():''"
                                                        style="padding:5px 5px;">
                                                        <i class="fa fa-trash text-white m-r-10"></i>

                                                    </a>

                                                    <form id="delete-form-{{ $company->id }}"
                                                        action="{{ route('company.destroy', $company->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf @method('delete')
                                                    </form>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" style="text-align: center;font-weight: 400;">Record Not Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div style="float: right;">
                            {!! $pages !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->

    <div class="modal fade  edit_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <form id="edit_modal_form" action="" method="post" enctype="multipart/form-data">

                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="">Picture</label>
                            <input type="file" class="form-control" name="profile_pic" id="edit_profile_pic"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Phone no</label>
                            <input type="number" class="form-control" name="contact_no" id="edit_contact_no"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name="status" id="edit_status">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Details</label>
                            <textarea class="form-control" name="details" id="edit_details" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade  add_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <form id="add_modal_form" action="{{ route('company.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="modal-header">
                        <h5 class="modal-title">Add</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="">Select Organization User *</label>
                            <select class="form-control" name="user_id" id="user_id">
                                @foreach ($users as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach

                                @if (count($users) <= 0)
                                    <option value=''> No user Found</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Picture</label>
                            <input type="file" class="form-control" name="profile_pic" id="profile_pic" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="">Phone no</label>
                            <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Details</label>
                            <textarea class="form-control" name="details" id="details" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade  view_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog" style="width: 50%; !important" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div>
                        <div><img src="..." alt="..." class="img-thumbnail"></div>
                        <div>
                            <label for=""></label>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
        integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            ShowLoader();
            $('[data-toggle="tooltip"]').tooltip();
            $(function() {
                // bind change event to select

            });
        });


        $(function() {

            $('.edit').on('click', function(e) {
                e.preventDefault();

                let href = $(this).attr('href');
                let action = $(this).data('update');

                CallAction(href, null, function(response) {

                    if (response.status) {

                        let data = response.data;

                        $('#edit_details').val(data.details);
                        $('#edit_status').val(data.status).change();
                        $('#edit_contact_no').val(data.contact_no);

                        $('.edit_modal').modal('show');

                        $('#edit_modal_form').attr('action', action);

                    } else {

                        alert(response.message);
                    }

                }, true);

            });

            $('#edit_modal_form').on('submit', function(e) {
                e.preventDefault();

                let url = $(this).attr('action');

                $.ajax({
                    url: url,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {
                        let response = data;

                        console.log({
                            response
                        });

                        if (response.status) {

                            $('.edit_modal').modal('hide');

                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.success(response.message);

                            window.location.reload();


                        } else {

                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.error(response.message);
                        }
                    }
                });
            });

            $('#add_model_id').on('click', function(e) {
                e.preventDefault();
                $('.add_modal').modal('show');
            })


            $('#add_modal_form').on('submit', function(e) {
                e.preventDefault();

                if ($('#user_id').val() == '') {

                    alert('please select user');

                } else {


                    let url = $(this).attr('action');

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function(data) {
                            let response = data;

                            if (response.status) {

                                $('.add_modal').modal('hide');

                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.success(response.message);

                                window.location.reload();


                            } else {

                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.error(response.message);
                            }
                        }
                    });
                }

            });

            $('.view').on('click', function(e) {
                e.preventDefault();
                $('#view_table').empty();

                let href = $(this).attr('href');

                CallAction(href, null, function(response) {

                    if (response.status) {

                        let data = response.data;



                        $('.view_modal').modal('show');

                    } else {

                        alert(response.message);
                    }

                }, true);

            });



        });

        $(window).load(function() {
            HideLoader();
        });
    </script>
@endpush
