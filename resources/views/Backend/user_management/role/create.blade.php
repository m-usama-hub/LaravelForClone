@extends('Backend.layouts.app')

@section('page-style')
    <style type="text/css">
   
        .form-group .input-group .icheck-list {
            padding-right: 0px!important;
        }
        .icheck-list {
            padding-right: 0px!important;
        }
        .form-group .input-group .icheck-list .icheckbox_line-red, .iradio_line-red{
           
            padding: 8px 15px 8px 38px!important; 
        }
        .icheckbox_line-red.checked, .iradio_line-red.checked {
            background: green!important;
       }
    </style>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    @include('Backend.layouts.partials.breadcumb',['data' => ['Roles','create'],'button'=>['display' => false]])

    <div class="container-fluid">
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-10 offset-md-1">
                        <h3 class="text-themecolor">{{ isset($title)?$title:''}}</h3>
                        @include('Backend.layouts.message')
                          
                        <form class="m-t-20" method="POST" action="{{route('role.store')}}"  novalidate autocomplete="off" id="frmValidate">
                            @csrf 
                         
                            <div class="row" >

                                <div class="col-md-12">
                                    <div class="form-group  ">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <div class="controls ">
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required data-validation-required-message="Name is required" autofocus> 
                                        </div>
                                        <span class="error">{{ $errors->first('name') }}</span>
                                    </div>

                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-primary" onclick="if(SubmitForm('frmValidate')){$('#frmValidate').submit();}">Save</button>
                                        <a href="{{ route('role.index') }}" class="btn btn-inverse">Back</a>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right" >
                                    <div class="" id="divCheckAll">
                                        <a href="javascript:void(0)" id="btnChkAll" class="btn btn-success" onclick="CheckAllBoxes()">
                                            Check All
                                        </a>
                                        <a href="javascript:void(0)" id="btnUnChkAll" class="btn btn-danger" onclick="UnCheckAllBoxes()">
                                            Un Check All
                                        </a>
                                    </div>        
                                </div>
                                <br>
                                <hr>
                                <div class="col-md-12 m-t-15" style="margin-top: 20px;">
                                    <div class="form-group m-t-15">
                                        <div class="input-group">
                                            <div class="col-lg-12 col-md-12 col-12" style="padding: 0em">
                                                @if(isset($permissions) && count($permissions) > 0 )
                                                    <div class="row" id="childCheck">
                                                        @foreach($permissions AS $k => $permission )
                                                            <div class="col-lg-4 col-md-6 col-12">
                                                                <span class="icheck-list " style="width:100%">
                                                                    <p class="zoomer" style="width:100%">
                                                                        <input type="checkbox" name="permission[]" class="check" id="chk-{{$k}}" value="{{ $permission->id }}" data-checkbox="icheckbox_line-red" data-label="{{$permission->name}}" >
                                                                        <label for="chk-{{$k}}">{{$permission->name}}</label>
                                                                    </p>
                                                                </span>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>        
                                </div>

                            </div>
                        </form>

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
        var TotalChkBox = $('#childCheck input[type="checkbox"]').length;
        var TotalCheckedChkBox = $('#childCheck input[type="checkbox"]:checked').length;
        // alert(JSON.stringify(TotalCheckedChkBox));
        if (TotalChkBox == TotalCheckedChkBox) 
        {
            $('#btnChkAll').hide();   
        }
        else
        {
            $('#btnUnChkAll').hide();
        }
        function CheckAllBoxes()
        {
            $('#childCheck .icheckbox_line-red').addClass("checked");
            $('#childCheck input[type=checkbox]').prop('checked',true);  

            $('#btnChkAll').hide();
            $('#btnUnChkAll').show();
        }
        function UnCheckAllBoxes()
        {
            $('#childCheck .icheckbox_line-red').removeClass("checked");    
            $('#childCheck input[type=checkbox]').prop('checked',false);  
            $('#btnUnChkAll').hide();   
            $('#btnChkAll').show();
        }
        // $("#divCheckAll .icheckbox_line-red").click(function(){
        //     if ($('#divCheckAll .icheckbox_line-red').hasClass("checked")) 
        //     {
        //         $('#childCheck .icheckbox_line-red').addClass("checked");    
        //     }
        //     else
        //     {
        //         $('#childCheck .icheckbox_line-red').removeClass("checked");    
        //     }
            
        // });
        
        // $(document).on("click" , "#divCheckAll .icheckbox_line-red" , function()
        //     {
        //         if ($('#divCheckAll .icheckbox_line-red').hasClass("checked")) 
        //         {
        //             $('#childCheck .icheckbox_line-red').addClass("checked");    
        //         }
        //         else
        //         {
        //             $('#childCheck .icheckbox_line-red').removeClass("checked");    
        //         }
        //     });
    </script>
@endsection