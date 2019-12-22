@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>SI</th>
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
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->profile->country->name }}</td>
                                        <td>
                                           @foreach($user->roles as $role)
                                               <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <a href="#0" class="">Edit</a>
                                            <a href="#0" class="">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
