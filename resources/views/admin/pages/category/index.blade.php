@extends('admin.master.layout')



@section('mainContent')

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h3>Category <span class="badge badge-secondary">{{ $categories->count() }}</span></h3>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a type="button" href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-secondary">New</a>
                </div>
            </div>
        </div>
    <div class="table-responsive">

        @include('admin.messages.msg')

        @if(!$categories->isEmpty())
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Updated_At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($categories as $key=>$category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <img style="width:60px; height: 80px" src="{{  Storage::url($category->thumbnail) }}" alt="">
                    </td>
                    <td>{{ $category->title }}</td>
                    <td>
                        {{ $category->parent['title'] }}
                    </td>
                    <td>
                        <a href="" class="badge {{ $category->status == 1 ? 'badge-success' : 'badge-secondary' }}">{{ $category->status == 1 ? 'Active' : 'Unactive' }}</a>
                    </td>
                    <td>{{ $category->updated_at->diffForHumans() }}</td>

                    <td>
                        <a class="btn btn-sm btn-secondary" href="{{ route('categories.show', $category->id) }}">show</a>
                        <a  class="btn btn-sm btn-secondary" href="{{ route('categories.edit', $category->id) }}">Edit</a>

                        <a  class="btn btn-sm btn-secondary" onclick="document.getElementById('role-form-{{ $category->id }}').submit()" href="#0">Delete</a>
                        <form style="display: none" action="{{ route('categories.destroy', $category->id) }}" id="role-form-{{$category->id}}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>

                    </td>
                </tr>
             @endforeach

            </tbody>
        </table>
            @else
            <p class="text-center" >There is a no Category Yet !!</p>
        @endif
    </div>
@endsection
