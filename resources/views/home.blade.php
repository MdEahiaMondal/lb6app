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

                    @include('admin.messages.msg')


                    <p>Token:
                        @if(session()->has('token'))
                            {{ session()->get('token') }}
                            @else
                            {{ 'Already Genarate' }}
                         @endif
                    </p>

                    <p>Encript: {{ request()->user()->secret ?? 'N/A' }}</p>
                    <p>Decript: {{ ($secret) ?? 'N/A' }}</p>


                        <form action="{{ route('home') }}" method="post">
                            @csrf
                            <input type="text" name="secret" class="form-control">
                            <button type="submit" class="btn btn-outline-primary">Genarate Token</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
