<?php

namespace App\Policies\Property;

use App\Enums\Clients\UserTypes;
use App\Models\Clients\User;
use App\Models\Property\Property;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any posts.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  User  $user
     * @param  Property  $property
     * @return mixed
     */
    public function view(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  User  $user
     * @returSocial\n mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  User  $user
     * @param  Property  $property
     * @return mixed
     */
    public function update(User $user, Property $property)
    {
        return ($user->id === $property->user_id);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  User  $user
     * @param  Property  $property
     * @return mixed
     */
    public function delete(User $user, Property $property)
    {
        return ($user->id === $property->user_id || $user->user_type == UserTypes::admin);
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  User  $user
     * @param  Property  $property
     * @return mixed
     */
    public function restore(User $user, Property $property)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  User  $user
     * @param  Property  $property
     * @return mixed
     */
    public function forceDelete(User $user, Property $property)
    {
        //
    }

}
