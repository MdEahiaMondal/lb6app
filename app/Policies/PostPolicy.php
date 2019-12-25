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
     * Determine whether the user can view any posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        $admin = $user->roles->where('name', 'admin')->first();
        return $post->user_id === $user->id || $admin ?
            Response::allow() : Response::deny('You are not Authorize to view post');
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role) ?
            Response::allow() : Response::deny('You are not Authorize to update post !');
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role) ?
            Response::allow() : Response::deny('You are not Authorize to delete post');
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role) ?
            Response::allow() : Response::deny('You are not Authorize to restore post');
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role) ?
            Response::allow() : Response::deny('You are not Authorize to forceDetele post');
    }


    public function wonPostShowAction(User $user, Post $post)
    {
        $role = $user->roles->pluck('name')->toArray();
        return $user->id === $post->user_id || in_array('admin', $role);

    }

}
