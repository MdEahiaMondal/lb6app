@extends('admin.master.layout')



@section('mainContent')
    <h3>Create New User</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" class="form-control" id="title" placeholder="Name">
            </div>

            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="username">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" value="12345678" name="password" class="form-control" id="password" placeholder="Enter your strong Password">
            </div>


            <div class="form-group">
                <label for="country">Country</label>
                <select name="country_id"  class="form-control" id="country">
                    <option value="0">Choose Country</option>
                    @if(!$countries->isEmpty())
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role_id[]"  class="form-control" id="role" multiple>
                    @if(!$roles->isEmpty())
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control-file" id="phone">
            </div>

            <div class="form-group">
                <label for="avatar">Image</label>
                <input type="file" name="avatar" class="form-control-file" id="avatar">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
