@extends('admin.master.layout')



@section('mainContent')
    <h3>User Edit</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" id="title" placeholder="Name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ $user->email }}" name="email" class="form-control" id="email" placeholder="Email">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select name="country_id"  class="form-control" id="country">
                    <option value="0">Choose Country</option>
                    @if(!$countries->isEmpty())
                        @foreach($countries as $country)
                            <option {{ $country->id == $user->profile->country_id ? 'selected': '' }}  value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role_id[]"  class="form-control" id="role" multiple>
                    @if(!$roles->isEmpty())
                        @foreach($roles as $role)
                            <option
                                @foreach($user->roles as $Urole)
                                    {{ $role->id == $Urole->id ? 'selected' : '' }}
                                @endforeach
                                value="{{ $role->id }}">{{ $role->name }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" value="{{ $user->profile->phone }}" name="phone" class="form-control-file" id="phone">
            </div>

            <div class="form-group">
                <img style="width: 100px; height: 100px;" src="{{ Storage::url($user->profile->avatar) }}" alt="">
                <label for="avatar">Image</label>
                <input type="file" name="avatar" class="form-control-file" id="avatar">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" name="address" id="address">{{ $user->profile->address }}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
