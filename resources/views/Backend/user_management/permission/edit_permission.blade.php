@extends('Backend.layouts.app')
@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @include('Backend.layouts.partials.breadcumb',['data' => ['Permissions','create'],'button'=>['display' => false]])

    <div class="container-fluid">
        <div class="card white-box">
                <div class="card-body">
                    <h2>Create Permissions</h2>
                    <hr />
                    @can('permission-create')
                    <form action="{{ route('create-permission.store') }}" method="POST">
                        @csrf
                        <div class="row display-flex" id="frmValidate">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Permission Name</label>
                                    <input type="text" name="permission_name" id="name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label><br />
                                    <button type="submit" class="btn btn-success zoomer">
                                        Add <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endcan
                    <!-- Data Table -->
                    <div class="table-responsive m-t-10">
                        <table class="tablesaw table-bordered table-hover table no-wrap" data-tablesaw-mode="swipe"
                            data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
                            data-tablesaw-mode-switch>
                            <thead>
                                <tr>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1" class="border">
                                        Sr #
                                    </th>
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2" class="border">
                                        Permission Name
                                    </th>
                                    
                                    <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4" class="border">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @if(isset($permissions) && count($permissions) > 0)
                                
                                    @foreach($permissions AS $k => $role)
                                        <tr>
                                            <td>{{ $k+1 }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-nowrap">
    
                                                @can('permission-edit')
                                                    <a href="{{ route('create-permission.edit',$role->id) }}" class="btn btn-success zoomer" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-white m-r-10"></i> Edit </a>
                                                @endcan
                                                
                                                @can('permission-delete')
                                                    <a href="" data-toggle="tooltip" class="btn btn-danger zoomer" data-original-title="Delete" onclick="event.preventDefault();  (confirm('Are you sure you want to delete this item?')) ? document.getElementById('delete-form-{{$role->id }}').submit():''">
                                                        <i class="fa fa-trash text-white m-r-10"></i> Delete
                                                    </a>
                                                    
                                                    <form id="delete-form-{{ $role->id }}" action="{{ route('create-permission.destroy',$role->id) }}" method="POST" style="display: none;">
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
                        {{-- <div  style="float: right;">
                            {!! $pages !!}
                        </div> --}}
                        
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
        $(document).ready(function(){

            //alert("Sss");
        });
    </script>
@endsection