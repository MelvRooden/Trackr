@if(session('success'))
    <div class="alert p-2 alert-temp mt-1 alert-success">
        {{__(session('success'))}}
    </div>
@endif

@if(session('error'))
    <div class="alert p-2 alert-temp mt-1 alert-danger">
        {{session('error')}}
    </div>
@endif
