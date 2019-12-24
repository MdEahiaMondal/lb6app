@extends('admin.master.layout')



@section('mainContent')
    <h3>Edit Post</h3>

    @include('admin.messages.msg')

    <div class="table-responsive">
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" value="{{ $post->title }}" name="title" class="form-control" id="title">
            </div>

            <div class="form-group">
                <img style="width: 80px; height: 80px;" src="{{Storage::url($post->thumbnail)}}" alt="">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control-file" id="thumbnail">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category_id[]"  class="form-control" id="category" multiple>
                    @if(!$categories->isEmpty())
                        @foreach($categories as $category)

                            <option
                                @if(in_array($category->id, $post->categories->pluck('id')->toArray()))
                                    {{ 'selected' }}
                                @endif
                                value="{{ $category->id }}">{{ $category->title }}
                            </option>

                        @endforeach
                    @endif
                </select>
            </div>




            <div class="form-group">
                <label for="content">Body</label>
                <textarea class="form-control" name="longtext" id="content">{!! $post->content !!}</textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="POST" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
