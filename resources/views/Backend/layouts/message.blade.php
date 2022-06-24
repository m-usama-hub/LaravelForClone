@if (session('error'))
	<div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if (session()->has('message') || session()->has('status'))
    <div class="alert alert-success" style="margin-top: 14px;">{{ session()->get('message') }}</div>
@endif

@if (session()->has('Success'))
	<div class="col-md-12 alert alert-success text-green alert-dismissible fade show" role="alert">
	    <span class="b-600">Success :</span>
	        <span>
	        	{{ session()->get('Success') }}
	        </span>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		    </button>
	</div>
@endif

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        <!-- <div class="alert alert-danger" style="margin-top: 14px;">{{ $error }}</div> -->
    @endforeach
@endif
