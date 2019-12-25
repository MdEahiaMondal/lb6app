<?php
namespace App\Gate;



use Illuminate\Auth\Access\Response;

class PostGate{

    public function allowed($user, $id)
    {
        return $user->id === $id;
    }


    public function allowedAction($user, $id)
    {
        $roles = $user->roles->pluck('name')->toArray();
       return $user->id === $id || in_array('admin', $roles) ? Response::allow() : Response::deny("You are not Authorized");
    }

}

