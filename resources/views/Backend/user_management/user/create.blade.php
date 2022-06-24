@extends('Backend.layouts.app')

@section('page-style')
    <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @include('Backend.layouts.partials.breadcumb', [
        'data' => ['Users', 'Add'],
        'button' => ['display' => false],
    ])

    <div class="container-fluid">
        <div class="card white-box">
            <div class="card white-box">
                <div class="card-body">
                    <h3 class="text-themecolor">{{ isset($title) ? $title : '' }}</h3>
                    <hr>
                    @include('Backend.layouts.message')

                    <form class="m-t-20" method="POST" action="{{ route('user.store') }}" novalidate
                        autocomplete="off" id="frmValidate">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group ">
                                    <h5>Name <span class="text-danger">*</span></h5>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        required data-validation-required-message="Name is required" autofocus>
                                    <span class="error">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                        required data-validation-required-message="Email field is required">
                                    <span class="error">{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Password <span class="text-danger">*</span></h5>
                                    <input type="password" name="password" class="form-control" required
                                        data-validation-required-message="Password is required">
                                    <span class="error">{{ $errors->first('password') }}</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Confirm Password <span class="text-danger">*</span></h5>
                                    <input type="password" name="confirm-password" data-validation-match-match="password"
                                        class="form-control" required
                                        data-validation-required-message="Confirmed password is required">
                                    <span class="error">{{ $errors->first('password') }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">  
                                <div class="form-group">
                                    <h5>User Type<span class="text-danger">*</span></h5>
                                    <select class="select2 form-control" name="user_type_id" id="user_type_id"
                                        data-placeholder="Select Roles" required
                                        data-validation-required-message="Please Select Role">
                                        <option value="" selected>---Select User Type---</option>
                                            @foreach (App\Models\User_type::get() as $type)
                                                <option value="{{ $type->id }}">{{ $type->user_type_name }}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Assign Role <span class="text-danger">*</span></h5>
                                    <select class="select2 form-control" name="roles[]" id="roles"
                                        data-placeholder="Select Roles" required
                                        data-validation-required-message="Please Select Role">
                                        <option value="" selected>---Select Role---</option>
                                        <@if (isset($roles) && count($roles) > 0)
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Status</h5>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="error">{{ $errors->first('status') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-primary"
                                onclick="if(SubmitForm('frmValidate')){$('#frmValidate').submit()}">Save</button>
                            <a href="{{ route('user.index') }}" class="btn btn-inverse">Back</a>
                        </div>
                    </form>
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
