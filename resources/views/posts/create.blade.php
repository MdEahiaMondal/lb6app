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

                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif


                            <form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                                </div>

                                <div class="form-group">
                                    <label for="body">body</label>
                                    <textarea name="body" id="body" class="form-control"></textarea>
                                </div>


                                <div class="form-group">
                                    <label for="status">status</label>
                                    <input type="checkbox" name="status" id="status" >
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" >
                                </div>

                                <div class="form-group">
                                    <label for="">
                                        <input type="checkbox" name="checkbox[]" value="khan">Khan
                                        <input type="checkbox" name="checkbox[]" value="arif">Arif
                                        <input type="checkbox" name="checkbox[]" value="mamu">mamu
                                        <input type="checkbox" name="checkbox[]" value="azizi">aziz
                                        <input type="checkbox" name="checkbox[]" value="habib vai">Habib vai
                                    </label>
                                </div>

                                <input type="password" name="password" value="{{ old('password') }}">

                                <div class="form-group">

                                    <input type="submit" value="Submit" id="image" >
                                </div>

                            </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
