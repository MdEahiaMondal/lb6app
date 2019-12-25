<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function allowed(User $user, Post $post)
    {
        $admin = $user->roles->where('name', 'admin')->first();
       return  $user->id === $post->user_id || $admin;
    }


    public function editAction(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role) ? Response::allow() : Response::deny('You are not Authorize to edit this Post');
    }

    public function deleteAction(User $user, Post $post)
    {
        $admin = $user->roles->where('name', 'admin')->first();
        return $user->id === $post->user_id  || $admin ? Response::allow() : Response::deny('You are not Authorize to delete this Post');
    }


}
