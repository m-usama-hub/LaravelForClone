@extends('Backend.layouts.app')

@section('content')
@include('Backend.layouts.partials.breadcumb',['data' => [$page->name,'Sections'],'button'=>['display' => true,'link'=>'addnewsectionpage','parameters' => $page->slug,'text'=>'Add New Section to this page']])
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$page->name}} Page Sections </h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Section Name</th>
                                    <th>On Pages</th>
                                    <th>Added By</th>
                                    <th>Is Active?</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{dd($page)}} --}}
                                @foreach($page->sections as $key=>$section)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$section->getSecName($section->avaliblesection_id)}}</td>
                                        <td>{{count($section->pages)}}</td>
                                        <td>{{$section->user->name}}</td>
                                        <td> <input type="checkbox" name="is_active" id="is_active" onclick="location.href='{{url('admin/'.$page->slug.'/is_active/'.$section->id.'/section')}}';" {{ $section->is_active == 1 ? "checked" :"unchecked" }}> </td>
                                        <td>
                                            <a href="{{ route('addnewsectionupdateview',[$section->id]) }}" target="_blank" class="btn btn-warning">Edit</a>
                                            <a href="{{ route('page',$page->slug) }}" target="_blank" class="btn btn-primary">Visit</a>
                                            <a href="{{ route('deletePageSection',[$page->slug,$section->id]) }}" class="btn btn-danger">Delete</a>
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