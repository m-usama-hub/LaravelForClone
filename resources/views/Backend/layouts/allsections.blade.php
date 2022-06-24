@extends('Backend.layouts.app')

@section('content')

@include('Backend.layouts.partials.breadcumb',['data' => [$page->name,'Sections','Add'],'button'=>['display' => false]])

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
          <div class="card-body">
            <h4 class="card-title">Theme Sections (Only Active)</h4> 

            <select id="select" class="form-control">
              <option value="sections" class="form-control" selected>Sections</option>
              <option value="forms" class="form-control">Forms</option>
            </select>

            <div class="sections box">
              @foreach($sections as $section)
                @if ($section->type == 'section')
                <div class="col-12">
                  <hr>
                    <a href="{{ route('inputfromdata',[ $page->slug ,$section->id]) }}" target="_blank" class="thumbnail">
                      <img src="{{ asset('/sections_img/'.$section->image) }}" width="100%">
                    </a>
                  </div>  
                @endif
              @endforeach
            </div>

            <div class="forms box">
              @foreach($sections as $section)
                @if ($section->type == 'form')
                <hr>
                    <a href="{{ route('inputfromdata',[ $page->slug ,$section->id]) }}" target="_blank" class="thumbnail">
                      <img src="{{ asset('/sections_img/'.$section->image) }}" width="100%">
                    </a>
                  </div> 
                @endif
              @endforeach
            </div>

          </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('script')
    
<script>
$(document).ready(function(){
    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue){
                $(".box").not("." + optionValue).hide();
                $("." + optionValue).show();
            } else{
                $(".box").hide();
            } 
        });
    }).change();
});
</script>

@endpush

   