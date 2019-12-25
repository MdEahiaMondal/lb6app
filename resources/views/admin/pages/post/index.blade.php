@extends('admin.master.layout')



@section('mainContent')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>posts <span class="badge badge-secondary">{{ $posts->count() }}</span></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a type="button" href="{{ route('posts.create') }}" class="btn btn-sm btn-outline-secondary">New</a>
                </div>
            </div>
        </div>
    <div class="table-responsive">

        @include('admin.messages.msg')

        @if(!$posts->isEmpty())
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>SI</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Creator</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Created_At</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($posts as $key=>$post)
                    <tr>
                        <td>{{ $key + 1  }}</td>
                        <td>
                            <img style="height: 60px; width: 60px" src="{{ Storage::url( $post->thumbnail) }}" alt="">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <a href="#0" class="badge {{ $post->status == 1 ? 'badge-success' : 'badge-secondary' }}">{{ $post->status == 1 ? 'Active' : 'Unactive' }}</a>
                        </td>
                        <td>
                            @foreach($post->categories as $category)
                                <span class="badge badge-primary">{{ $category->title }}</span>
                            @endforeach
                        </td>

                        <td>
                          {{ $post->created_at }}
                        </td>

                        <td>

                                <a  href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-secondary">Show</a>
                            @can("isAllowed", $post->user->id)
                                <a  href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-secondary">Edit</a>
                                <a  href="#0" onclick="document.getElementById('user-form-{{ $post->id }}').submit()" class="btn btn-sm btn-secondary">Delete</a>

                                <form style="display: none" action="{{ route('posts.destroy', $post->id) }}" id="user-form-{{ $post->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endcan
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
