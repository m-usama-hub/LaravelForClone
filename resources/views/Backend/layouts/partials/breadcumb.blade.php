<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-5">
            <h4 class="page-title">Dashboard</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach ($data as $item)
                            <li class="breadcrumb-item"><a href="">{{ $item }}</a></li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
        @if ($button['display'] == true)
            <div class="col-7">
                @if (Route::currentRouteName() == 'pages')
                    {{-- <form action="{{ route('newpage') }}" method="post">
                    @csrf  
                    <div class="input-group">
                        <input type="text" class="form-control" name="pagename" placeholder="Enter Page Name" required>
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Add New</button>
                        </span>
                    </div>
                </form> --}}
                @else
                    <div class="text-right upgrade-btn">
                        <a href="{{ route($button['link'], $button['parameters']) }}"
                            {{ $isModal ?? false == true ? 'data-target="' . $modalId ?? '' . '" data-toggle="modal"' : '' }}
                            id="{{ $id ?? '' }}" class="btn btn-danger text-white">{{ $button['text'] }} </a>
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>
