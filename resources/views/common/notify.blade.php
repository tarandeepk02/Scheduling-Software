@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!--@if(Session::has('flash_error'))
    <div class="alert alert-danger">
        {{ Session::get('flash_error') }}
    </div>
@endif


@if(Session::has('flash_success'))
    <div class="alert alert-success">
        {{ Session::get('flash_success') }}
    </div>
@endif-->