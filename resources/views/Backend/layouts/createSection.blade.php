@extends('Backend.layouts.app')

@section('content')
@include('Backend.layouts.partials.breadcumb',['data' => ['Section','Add New'], 'button' => [ 'display' => false]])
<div class="row">
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-material" action="{{ route('addnewsection') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-md-12">Section Name</label>
                    <div class="col-md-12">
                        <input type="text" name="name" placeholder="Home Slider, etc"
                            class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Section Image</label>
                    <div class="col-md-12">
                        <input type="file" name="image" placeholder="Section display Image"
                            class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12"> Section Html Path</label>
                    <div class="col-md-12">
                        <input type="text" name="html" placeholder="Html link"
                            class="form-control form-control-line">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success" type="submit">Add Section</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('Backend/assets/global/plugins/bootstrap-table/bootstrap-table.min.js') }}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@endpush
