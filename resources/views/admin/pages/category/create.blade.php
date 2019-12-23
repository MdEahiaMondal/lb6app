@extends('admin.master.layout')



@section('mainContent')
    <h3>Create New Category</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Sub Category</label>
                <select name="parent_id"  class="form-control" id="exampleFormControlSelect1">
                    <option value="0">Choose Sub-Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                   @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="thumbnail">Image</label>
                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
            </div>

            <div class="form-group">
                <label for="content">Description</label>
                <textarea class="form-control" name="content" id="content"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Add" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
