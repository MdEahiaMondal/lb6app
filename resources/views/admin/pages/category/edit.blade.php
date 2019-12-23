@extends('admin.master.layout')



@section('mainContent')
    <h3>Category Edit</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" value="{{ $category->title }}" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Sub Category</label>
                <select name="parent_id"  class="form-control" id="exampleFormControlSelect1">
                    <option value="0">Choose Sub-Category</option>
                    @foreach($categories as $cat)
                        <option
                            @if($category->parent != null )
                                {{ $category->parent->id == $cat->id ? 'selected' : '' }}
                             @endif
                            value="{{ $cat->id }}">{{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">

                <img style="width: 100px; height: 100px" src="{{ Storage::url($category->thumbnail) }}" alt="">

                <label for="thumbnail">Image</label>
                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
            </div>

            <div class="form-group">
                <label for="content">Description</label>
                <textarea class="form-control" name="content" id="content">{{ $category->content }}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Update" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
