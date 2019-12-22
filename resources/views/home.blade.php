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


                    @php
                        $mun = [1,2,3,4,5,6,7,8,9,10,21,0,1,20,1,05,12,0,54,051,20,5454,0,5545];
                   @endphp

                        @foreach($mun as $num)
{{--                            {{ dd($loop) }}--}}

                            {{ $loop->even }}

                        @endforeach



                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
