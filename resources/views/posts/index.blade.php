@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <a href="{{ route('posts.create') }}"> Create Post</a>

                        <table class="table table-hover">
                            <tbody>
                                <th>SI</th>
                                <th>Title</th>
                                <th>Body</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tbody>

                            <tbody>

                                @foreach($posts as $key=>$post)
                                    <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>{{ $post->status }}</td>
                                    <td>Edit</td>
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
