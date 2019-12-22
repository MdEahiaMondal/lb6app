@extends('admin.master.layout')



@section('mainContent')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Role <span class="badge badge-secondary">{{ $roles->count() }}</span></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a type="button" href="{{ route('roles.create') }}" class="btn btn-sm btn-outline-secondary">New</a>
                </div>
            </div>
        </div>
    <div class="table-responsive">
        @if(!$roles->isEmpty())
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Name</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Users</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($roles as $key=>$role)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at->diffForHumans() }}</td>
                    <td>{{ $role->updated_at->diffForHumans() }}</td>
                    <td>
                        <span class="badge badge-secondary">{{ $role->users->count() }}</span>
                    </td>
                    <td>
                        <a href="{{ route('roles.show', $role->id) }}">show</a>
                        <a href="{{ route('roles.edit', $role->id) }}">Edit</a>

                        <a onclick="document.getElementById('role-form-{{ $role->id }}').submit()" href="#0">Delete</a>
                        <form style="display: none" action="{{ route('roles.destroy', $role->id) }}" id="role-form-{{$role->id}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>

                    </td>
                </tr>
             @endforeach

            </tbody>
        </table>
            @else
            <p class="text-center" >There is a no Role Yet !!</p>
        @endif
    </div>
@endsection
