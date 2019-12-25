@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif


@if(Session::has('error'))
    <div class="alert alert-danger">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <p>{{ $error }}</p>
        </div>
    @endforeach
@endif
