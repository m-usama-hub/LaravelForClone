@extends('Backend.layouts.app')
@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->

    @can('role-create')
        @include('Backend.layouts.partials.breadcumb', [
            'data' => ['Roles'],
            'button' => [
                'display' => true,
                'link' => 'role.create',
                'parameters' => null,
                'text' => 'Create Role',
            ],
        ])
    @endcan
    <div class="container-fluid">
        <div class="card white-box">
            <div class="card-body">

                <div class="text-left">
                    <h3 class="text-themecolor">{{ isset($title) ? $title : '' }}</h3>
                </div>

                @can('role-create')
                    <div class="text-right" style="margin-top: -37px!important">
                        <a href="{{route('role.create')}}" class="btn btn-gr-red">Create Role</a>  
                    </div>
                @endcan

                <form class="m-t-20" action="{{ route('role.index') }}" autocomplete="off">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Role Name</h5>
                                <div class="controls">
                                    <input type="text" name="name" value="{{ Request::get('name') }}" id="name"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Select Per Page</h5>
                                <div class="controls">
                                    <select class=" form-control" id="per_page" name="per_page">
                                        <option value="12" {{ $per_page == 12 ? 'selected' : '' }}>12 Per Page</option>
                                        <option value="24" {{ $per_page == 24 ? 'selected' : '' }}>24 Per Page</option>
                                        <option value="50" {{ $per_page == 50 ? 'selected' : '' }}>50 Per Page</option>
                                        <option value="100" {{ $per_page == 100 ? 'selected' : '' }}>100 Per Page</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 ">
                            <div class="form-group">
                                <h5>&nbsp;</h5>
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Search <i class="fa fa-search"
                                            aria-hidden="true"></i></button>
                                </div>
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
                        <thead>
                            <tr>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"
                                    class="border">
                                    Sr #
                                </th>
                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2"
                                    class="border">
                                    Role Name
                                </th>

                                <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                    class="border">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (isset($roles) && count($roles) > 0)
                                @foreach ($roles as $k => $role)
                                    <tr>
                                        <td>{{ ++$k + ($roles->currentPage() - 1) * $per_page }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td class="text-nowrap">

                                            @can('role-edit')
                                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-success zoomer"
                                                    data-toggle="tooltip" data-original-title="Edit"> <i
                                                        class="fa fa-pencil text-white m-r-10"></i> Edit </a>
                                            @endcan

                                            @can('role-delete')
                                                <a href="" data-toggle="tooltip" class="btn btn-danger zoomer"
                                                    data-original-title="Delete"
                                                    onclick="event.preventDefault();  (confirm('Are you sure you want to delete this item?')) ? document.getElementById('delete-form-{{ $role->id }}').submit():''">
                                                    <i class="fa fa-trash text-white m-r-10"></i> Delete
                                                </a>

                                                <form id="delete-form-{{ $role->id }}"
                                                    action="{{ route('role.destroy', $role->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf @method('delete')
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" style="text-align: center;font-weight: 400;">Record Not Found</td>
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

    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
@endsection

{{-- @section('page-script')
    
   
    <script>
        $(document).ready(function(){

            $(function(){
                // bind change event to select
                $('#per_page').on('change', function () {
                    var url = $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = '?per_page='+url; // redirect
                    }
                    return false;
                });
            });
        });
    </script>
@endsection --}}
