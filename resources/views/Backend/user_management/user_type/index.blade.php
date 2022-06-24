@extends('Backend.layouts.app')


@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->



    <div class="container-fluid">
        <div class="card white-box">
            <div class="card white-box">
                <div class="card-body">

                    <div class="">
                        <h3 class="text-themecolor">{{ isset($title) ? $title : '' }}</h3>
                    </div>

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
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                        class="border">
                                        User Type
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4"
                                        class="border">
                                        Roles
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5"
                                        class="border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-center-last">
                                @if (isset($user_types) && count($user_types) > 0)
                                    @foreach ($user_types as $k => $type)
                                        <tr>
                                            <td>{{ ++$k }}</td>
                                            
                                            <td>{{ $type->user_type_name }}</td>

                                            <td align="center">
                                                @if (count($type->getRoleNames()) > 0)
                                                    @foreach ($type->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @else
                                                    <label>No Roles</label>
                                                @endif
                                            </td>

                                            <td class="text-nowrap" align="center">
                                                {{-- @can('mapping-edit') --}}
                                                    <a href="{{ route('mapping.edit', $type->slug) }}"
                                                        class="btn btn-success zoomer" data-toggle="tooltip"
                                                        data-placement="top" title="Tooltip on top" style="padding:5px 5px;">
                                                        <!-- <i class="fa fa-pencil text-white m-r-10"></i>  --> Edit
                                                    </a>
                                                {{-- @endcan --}}

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
                        {{-- <div style="float: right;">
                            {!! $pages !!}
                        </div> --}}
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
