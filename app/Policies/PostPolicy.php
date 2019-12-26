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
    public function viewAny(?User $user) // (?) thats mains if a user is authcation or not he can access
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
        return $post->user_id === $user->id  ? $this::allow() : $this::deny('You are not Authorize to view post');
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
    public function update(User $user, Post $post) // here ($this) work same to Response  as your choose
    {
        return $user->id === $post->user_id ? $this::allow() : $this::deny('You are not Authorize to update post !');
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
        return $user->id === $post->user_id ? Response::allow() : Response::deny('You are not Authorize to delete post');
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
        return $user->id === $post->user_id ? Response::allow() : Response::deny('You are not Authorize to restore post');
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
        return $user->id === $post->user_id ? $this::allow() : $this::deny('You are not Authorize to forceDetele post');
    }


    public function wonPostShowAction(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }


    public function before(User $user) // For certain users, you may wish to authorize all actions within a given policy. To accomplish this, define a before method on the policy
    {
        $admin = $user->roles->where('name', 'admin')->first();
        return $admin ? true : null;
    }


}
