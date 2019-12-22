@extends('admin.master.layout')



@section('mainContent')
    <h3>Create New Role</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form class="form-inline" method="post" action="{{ route('roles.store') }}">
            @csrf
            <div class="form-group mx-sm-2 mb-2">
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Role Name">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Add</button>
        </form>
    </div>
@endsection
