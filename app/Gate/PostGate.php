<?php
namespace App\Gate;

class PostGate{

    public function allowed($user, $id)
    {
        return $user->id === $id;
    }

}

