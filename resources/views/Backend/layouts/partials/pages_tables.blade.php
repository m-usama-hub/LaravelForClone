@extends('Backend.layouts.app')

@section('content')
@include('Backend.layouts.partials.breadcumb',['data' => ['Pages'],'button' => [ 'display' => true]])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pages Table</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr align="center">
                                    <td align="center"> <strong>#</strong> </td>
                                    <td align="center"> <strong>Page Name</strong> </td>
                                    <td align="center"> <strong>No of Sections</strong></t>
                                    <td align="center"> <strong>Added By</strong> </td>
                                    <td align="center"> <strong>Is Active?</strong> </td>
                                    <td align="center"> <strong>Front page?</strong> </td>
                                    <td align="center"><strong> Actions</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $key=>$page)
                                    <tr align="center">
                                        <th scope="row">{{$key+1}}</th>
                                        <td align="center">{{$page->name}}</td>
                                        <td align="center">{{count($page->sections)}}</td>
                                        <td align="center">{{$page->user->name}}</td>
                                        <td align="center"><input type="checkbox" name="is_active" onclick="location.href='{{url('admin/is_active/'.$page->id)}}';" id="is_active" {{ $page->is_active == 1 ? 'checked' : 'unchecked' }} > </td>
                                        <td align="center"><input type="radio" name="front" onclick="location.href='{{url('admin/is_front/'.$page->id)}}';" id="is_front" {{ $page->is_front == 1 ? 'checked' : 'unchecked' }} > </td>
                                        <td align="center">
                                            <a href="{{ route('page',$page->slug) }}" target="_blank" class="btn btn-primary">Visit</a>
                                            <a href="{{ route('pagesections',$page->slug) }}" class="btn btn-secondary">Show Sections</a>
                                            <a href="{{ route('delete',$page->slug) }}" class="btn btn-danger">Delete</a>
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
