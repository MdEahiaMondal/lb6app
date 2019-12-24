@extends('admin.master.layout')



@section('mainContent')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Users <span class="badge badge-secondary">{{ $users->count() }}</span></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a type="button" href="{{ route('users.create') }}" class="btn btn-sm btn-outline-secondary">New</a>
                </div>
            </div>
        </div>
    <div class="table-responsive">

        @include('admin.messages.msg')

        @if(!$users->isEmpty())
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>SI</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $key=>$user)
                    <tr>
                        <td>{{ $key +1  }}</td>
                        <td>
                            @if($user->profile)
                                <img style="height: 60px; width: 60px" src="{{ Storage::url( $user->profile->avatar) }}" alt="">
                                @else
                                <p>No image yet</p>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        @if($user->profile)
                            <td>{{ $user->profile->country->name }}</td>
                            @else
                            <p>No country yet</p>
                        @endif

                        <td>

                        @if($user->roles)
                                @foreach($user->roles as $role)
                                    <span class="badge badge-primary">{{ $role->name }}</span>
                                @endforeach
                        @else
                            <p>No country yet</p>
                        @endif


                        </td>

                        <td>
                            <a  href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-secondary">Show</a>
                            <a  href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <a  href="#0" onclick="document.getElementById('user-form-{{ $user->id }}').submit()" class="btn btn-sm btn-secondary">Delete</a>

                            <form style="display: none" action="{{ route('users.destroy', $user->id) }}" id="user-form-{{ $user->id }}" method="post">
                                @csrf
                                @method('DELETE')
                            </form>

                        </td>

                    </tr>
                @endforeach

                </tbody>

            </table>
        @else
            <p class="text-center" >There is a no User Yet !!</p>
        @endif
    </div>
@endsection
