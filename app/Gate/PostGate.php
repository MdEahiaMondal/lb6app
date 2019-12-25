<?php
namespace App\Gate;



use Illuminate\Auth\Access\Response;

class PostGate{

    public function allowed($user, $id)
    {
        $roles = $user->roles->pluck('name')->toArray();
        return $user->id === $id || in_array('admin', $roles);
    }


    public function allowedEditAction($user, $id)
    {
        $roles = $user->roles->pluck('name')->toArray();
       return $user->id === $id || in_array('admin', $roles) ? Response::allow() : Response::deny("You are not Authorized to edit this Post");
    }

    public function allowedDeleteAction($user, $id)
    {
        $roles = $user->roles->pluck('name')->toArray();
       return $user->id === $id || in_array('admin', $roles) ? Response::allow() : Response::deny("You are not Authorized to delete this Post");
    }

}

