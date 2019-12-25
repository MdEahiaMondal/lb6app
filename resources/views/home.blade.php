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

                    <p>Token:
                        @if(session()->has('token'))
                            {{ session()->get('token') }}
                            @else
                            {{ 'Already Genarate' }}
                         @endif
                    </p>
{{--                    <p>Token: {{ auth()->user()->token_api ?? 'Already Genarate' }}</p>--}}

                        <form action="{{ route('home') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary">Genarate Token</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
