@extends('Backend.layouts.app')

@section('page-style')
    <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @include('Backend.layouts.partials.breadcumb',['data' => ['Users','Edit'],'button'=>['display' => false]])

    <div class="container-fluid">
        <div class="card white-box">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="text-themecolor">{{ isset($title)?$title:''}}</h3>
                        @include('Backend.layouts.message')
                          
                        <form class="m-t-20" method="POST" action="{{route('user.update', $user->id)}}"  novalidate autocomplete="off">
                            @csrf @method('patch')
                         
                            <div class="row">
                                <div class="form-group col-md-6 ">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <div class="controls ">
                                        <input type="text" name="name" value="{{ old('name')??$user->name }}" class="form-control" required data-validation-required-message="Name is required" autofocus> 
                                    </div>
                                    <span class="error">{{ $errors->first('name') }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" value="{{ old('email')??$user->email }}" class="form-control" required data-validation-required-message="Email field is required"> 
                                    </div>
                                    <span class="error">{{ $errors->first('email') }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <h5>Password</h5>
                                    <div class="controls">
                                        <input type="password" name="password"  class="form-control"> 
                                    </div>
                                    <span class="error">{{ $errors->first('password') }}</span>
                                </div>

                                <div class="form-group col-md-6">
                                    <h5>Confirm Password</h5>
                                    <div class="controls">
                                        <input type="password" name="confirm-password" data-validation-match-match="password" class="form-control"> 
                                    </div>
                                    <span class="error">{{ $errors->first('password') }}</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group  col-md-6">
                                    <h5>Assign Role <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select class="select2 form-control" name="roles[]" multiple id="roles" data-placeholder="Select Roles" required data-validation-required-message="Please Select Role">
                                            <option value="">Select Role</option>
                                            <@if(isset($roles) && count($roles) > 0)
                                                    @foreach ($roles as $role)
                                                        <option {{ isset($userRole[$role->name])?'selected':'' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                        <span class="error">{{ $errors->first('roles') }}</span>
                                    </div>
                                </div>
                                
                                <!-- <div class="form-group col-md-6">
                                    <h5>Status</h5>
                                    <select name="isApproved" class="form-control">
                                        <option {{ ($user->isApproved == 1)?'selected':'' }} value="1">Approved</option>
                                        <option {{ ($user->isApproved == 0)?'selected':'' }} value="0">Not Approved</option>
                                    </select>
                                    <span class="error">{{ $errors->first('isApproved') }}</span>
                                </div>  -->
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-info">Update</button>
                                <a href="{{ route('user.index') }}" class="btn btn-inverse">Back</a>
                            </div>
                        </form>

                    </div>
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
<script type="text/javascript" src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
@endsection