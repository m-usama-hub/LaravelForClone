@extends('Backend.layouts.app')


@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @can('user-create')
        @include('Backend.layouts.partials.breadcumb', [
            'data' => ['Users'],
            'button' => [
                'display' => true,
                'link' => 'user.create',
                'parameters' => null,
                'text' => 'Add New User',
            ],
        ])
    @endcan


    <div class="container-fluid">
        <div class="card white-box">
            <div class="card white-box">
                <div class="card-body">
                    @can('user-create')
            <div class="">
                <a href="{{route('user.create')}}" class="btn btn-gr-red zoomer">Create New User</a>
            </div>
            @endcan

                    <div class="">
                        <h3 class="text-themecolor">{{ isset($title) ? $title : '' }}</h3>
                    </div>
                    <hr>
                    <form class="m-t-20" action="{{ route('user.index') }}" autocomplete="off" id="frmUserList">
                        <div class="row">
                            <div class="col-md-2">
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
                                    <h5>UserType</h5>
                                    <div class="controls">
                                        <select class=" form-control" id="user_type" name="user_type_id">
                                            <option value="" selected>
                                                -- Select UserType --
                                            </option>
                                            @if (count(App\Models\User_type::get()) > 0)
                                                @foreach (App\Models\User_type ::get() as $k => $record)
                                                    <option value="{{ $record->id }}"
                                                        {{ Request::get('user_type_id') == $record->id ? 'selected' : '' }}>
                                                        {{ $record->user_type_name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" selected disabled class="text-danger">
                                                    UserTypes Are Not Found.
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Roles</h5>
                                    <div class="controls">
                                        <select class=" form-control" id="role" name="role">
                                            <option value="" selected>
                                                -- Select Role --
                                            </option>
                                            @if (count(Spatie\Permission\Models\Role::get()) > 0)
                                                @foreach (Spatie\Permission\Models\Role::get() as $k => $record)
                                                    <option value="{{ $record->name }}"
                                                        {{ Request::get('role') == $record->name ? 'selected' : '' }}>
                                                        {{ $record->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="" selected disabled class="text-danger">
                                                    Roles Are Not Found.
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
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

                            <div class="col-md-1">
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
                                    {{-- <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2"
                                        class="border">
                                        User Type
                                    </th> --}}
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3"
                                        class="border">
                                        Email
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                        class="border">
                                        User Type
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                        class="border">
                                        Roles
                                    </th>
                                    <!-- <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4" class="border">
                                                                        Status
                                                                    </th> -->
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5"
                                        class="border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center-last">
                                @if (isset($users) && count($users) > 0)
                                    @foreach ($users as $k => $user)
                                        <tr>
                                            <td>{{ ++$k + ($users->currentPage() - 1) * $per_page }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            
                                            <td><label class="badge badge-secondary">{{ !empty($user->UserType) ? $user->UserType->user_type_name : '' }}</label></td>

                                            <td align="center">
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <!-- <td>
                                                                                <span class='{{ $user->isApproved == 1 ? 'text-success' : 'text-danger' }}'>
                                                                                    {{ $user->isApproved == 1 ? 'Approved' : 'Not Approved' }}
                                                                                </span>

                                                                            </td> -->

                                            <td class="text-nowrap" align="center">
                                                @can('user-edit')
                                                    <a href="{{ route('user.edit', $user->id) }}"
                                                        class="btn btn-success zoomer" data-toggle="tooltip"
                                                        data-placement="top" title="Tooltip on top" style="padding:5px 5px;">
                                                        <!-- <i class="fa fa-pencil text-white m-r-10"></i>  --> Edit
                                                    </a>
                                                @endcan


                                                @can('user-delete')
                                                    <a href="" class="btn btn-danger" data-toggle="tooltip"
                                                        data-original-title="Delete"
                                                        onclick="event.preventDefault();  (confirm('Are you sure you want to delete this User? Each and Every record of this user will be deleted from protal.')) ? document.getElementById('delete-form-{{ $user->id }}').submit():''"
                                                        style="padding:5px 5px;">
                                                        <!-- <i class="fa fa-trash text-danger m-r-10"></i> -->
                                                        Delete
                                                    </a>

                                                    <form id="delete-form-{{ $user->id }}"
                                                        action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        style="display: none;">
                                                        @csrf @method('delete')
                                                    </form>
                                                @endcan

                                            </td>


                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align: center;font-weight: 400;">Record Not Found</td>
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
@endsection

@section('page-script')
    <script>
        $(document).ready(function() {
            ShowLoader();
            $('[data-toggle="tooltip"]').tooltip();
            $(function() {
                // bind change event to select
                $('#per_page,#user_type_id').on('change', function() {
                    var url = $(this).val(); // get selected value
                    ShowLoader();
                    $("#frmUserList").submit();
                    if (url) { // require a URL
                        // window.location = '?per_page='+url; // redirect
                    }
                    return false;
                });
            });
        });
        $(window).load(function() {
            HideLoader();
        });
    </script>
@endsection
