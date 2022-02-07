<?php

namespace App\Policies;

use App\Models\Layout;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LayoutPolicy
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
        return $user->hasPermissionTo('Voir toutes les MEA');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Layout  $layout
     * @return mixed
     */
    public function view(User $user, Layout $layout)
    {
        return $user->hasPermissionTo('Voir une MEA');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer une MEA');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Layout  $layout
     * @return mixed
     */
    public function update(User $user, Layout $layout)
    {
        return $user->hasPermissionTo('Éditer une MEA');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Layout  $layout
     * @return mixed
     */
    public function delete(User $user, Layout $layout)
    {
        return $user->hasPermissionTo('Supprimer une MEA');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Layout  $layout
     * @return mixed
     */
    public function restore(User $user, Layout $layout)
    {
        return $user->hasPermissionTo('Restaurer une MEA');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Layout  $layout
     * @return mixed
     */
    public function forceDelete(User $user, Layout $layout)
    {
        return $user->hasPermissionTo('Supprimer de force une MEA');
    }
}
