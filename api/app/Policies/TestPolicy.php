<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Test;
use Illuminate\Auth\Access\HandlesAuthorization;

class TestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('Voir tous les tests');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function view(User $user, Test $test)
    {
        return $user->hasPermissionTo('Voir un test');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer un test');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function update(User $user, Test $test)
    {
        return $user->hasPermissionTo('Éditer un test');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function delete(User $user, Test $test)
    {
        return $user->hasPermissionTo('Supprimer un test');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function restore(User $user, Test $test)
    {
        return $user->hasPermissionTo('Restaurer un test');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Test  $test
     * @return mixed
     */
    public function forceDelete(User $user, Test $test)
    {
        return $user->hasPermissionTo('Supprimer de force un test');
    }
}
