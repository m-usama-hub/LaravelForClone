@extends('Backend.layouts.app')

@section('content')
{{--@include('Backend.layouts.partials.breadcumb',['data' => ['Sections'],'button'=>['display' => true,'link'=>'UploadNewSection','parameters' => null,'text'=>'Add New Section']])--}}
@include('Backend.layouts.partials.breadcumb',['data' => ['Sections'],'button'=>['display' => false]])

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">All Sections</h4>
                    <div class="row" id="alert">
                        <div class="col-lg-12">
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif      
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr align="center">
                                    <td align="center"> <strong>#</strong> </td>
                                    <td align="center"> <strong>Section Name</strong> </td>
                                    <td align="center"> <strong>Section Type</strong> </td>
                                    <td align="center"> <strong>Added By</strong> </td>
                                    {{-- <td align="center"> <strong> <a href="{{ route('ActiveAllSections') }}"> Is Active? </a> </strong> </td> --}}
                                    <td></td>
                                </tr> 
                            </thead>
                            <tbody>
                                @foreach($sections as $key=>$section)
                                    <tr align="center">
                                        <td>{{$key+1}}</td>
                                        <td align="center">{{$section->name}}</td>
                                        <td align="center">{{$section->type}}</td>
                                        <td align="center">{{$section->user->name}}</td>
                                        {{-- <td align="center"><input type="checkbox" name="is_active" onclick="location.href='{{url('admin/is_active/'.$section->id.'/section')}}';" id="is_active" {{ $section->is_active == 1 ? 'checked' : 'unchecked' }} > </td> --}}
                                        <td>
                                            @if ($section->type == 'section')
                                                <a href="{{ route('showsection',$section->id) }}" class="btn btn-link" target="_blank"> Show section</a>                                                
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
setTimeout(function() {
    $('#alert').fadeOut('slow');
}, 2000);
</script>

@endpush
