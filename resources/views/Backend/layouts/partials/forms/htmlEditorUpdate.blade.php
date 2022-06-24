<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Semje</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('./css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('./css/carousel.css') }}" rel="stylesheet">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

    <form action="{{ route('addnewsectionupdate',[$sec->id]) }}"  method="post" onsubmit="gethtml()" onended="window.close()">
        @csrf
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{ asset('./img/nogd-logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto" id="navbar">
                        
                        <li class="nav-item login-btn">
                            <input class="btn btn-primary" type="submit" value="Save and Update">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br><br><br><br><br>
    <div class="editable_content_div">
            {!! $sec->data !!}
    </div>
    
    <textarea name="data" id="data" cols="30" rows="10" hidden>  </textarea>
    </form>

    {{-- @include('Frontend.layouts.footer'); --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        var id = $('.editable_content_div section').attr("id");
    
       if(id == "contact-former" || id == "contact-form"){

        $('form').submit();
           
       }else{
        $(".editable_content_div div.container").attr("contentEditable", true);
           $(".editable_content_div div.container").attr("id", "container");
    
            var editor = CKEDITOR.inline( 'container' );
            CKFinder.setupCKEditor( editor );
       }
        
            function gethtml(){
                
		        $(".editable_content_div div.container").removeAttr("contentEditable tabindex spellcheck role aria-multiline aria-label title aria-describedby style");
                $(".editable_content_div div.container").removeClass("cke_editable cke_editable_inline cke_contents_ltr cke_show_borders");
                

                var insertText = $(".editable_content_div").html();
                $('#data').val(insertText);
                
            }
        
    </script>


</body>
</html>
