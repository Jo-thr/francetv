<?php

namespace App\Policies;

use App\Models\MetaMedia;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetaMediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Voir tous les metamedia');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\MetaMedia  $metaMedia
     * @return mixed
     */
    public function view(User $user, MetaMedia $metaMedia)
    {
        return $user->hasPermissionTo('Voir un metamedia');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer un metamedia');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\MetaMedia  $metaMedia
     * @return mixed
     */
    public function update(User $user, MetaMedia $metaMedia)
    {
        return $user->hasPermissionTo('Éditer un metamedia');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\MetaMedia  $metaMedia
     * @return mixed
     */
    public function delete(User $user, MetaMedia $metaMedia)
    {
        return $user->hasPermissionTo('Supprimer un metamedia');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\MetaMedia  $metaMedia
     * @return mixed
     */
    public function restore(User $user, MetaMedia $metaMedia)
    {
        return $user->hasPermissionTo('Restaurer un metamedia');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\MetaMedia  $metaMedia
     * @return mixed
     */
    public function forceDelete(User $user, MetaMedia $metaMedia)
    {
        return $user->hasPermissionTo('Supprimer de force un metamedia');
    }
}
