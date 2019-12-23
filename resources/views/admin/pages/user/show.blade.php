@extends('admin.master.layout')



@section('mainContent')
    <h3>Details Role</h3>

    <div class="table-responsive">




            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="border-bottom border-gray pb-2 mb-0">Role Users</h6>

                @foreach($role->users as $user)
                    <div class="media text-muted pt-3">
                        <img src="{{ $user->profile->avatar }}" style="width: 60px; height: 40px" alt="" class="mr-2 rounded">
                        <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark">{{ $user->name }}</strong>
                                <a href="#">Follow</a>
                            </div>
                            <span class="d-block">{{ $user->email }}</span>
                        </div>
                    </div>
                @endforeach



                {{--<small class="d-block text-right mt-3">
                    <a href="#">All suggestions</a>
                </small>--}}
            </div>
    </div>
@endsection
