<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sponsor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SponsorPolicy
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
        return $user->hasPermissionTo('Voir tous les sponsors');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sponsor  $sponsor
     * @return mixed
     */
    public function view(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('Voir un sponsor');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer un sponsor');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sponsor  $sponsor
     * @return mixed
     */
    public function update(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('Éditer un sponsor');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sponsor  $sponsor
     * @return mixed
     */
    public function delete(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('Supprimer un sponsor');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sponsor  $sponsor
     * @return mixed
     */
    public function restore(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('Restaurer un sponsor');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Sponsor  $sponsor
     * @return mixed
     */
    public function forceDelete(User $user, Sponsor $sponsor)
    {
        return $user->hasPermissionTo('Supprimer de force un sponsor');
    }
}
