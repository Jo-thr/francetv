<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Departement as Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
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
        return $user->hasPermissionTo('Voir tous les services');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function view(User $user, Service $service)
    {
        return $user->hasPermissionTo('Voir un service');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer un service');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function update(User $user, Service $service)
    {
        return $user->hasPermissionTo('Éditer un service');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function delete(User $user, Service $service)
    {
        return $user->hasPermissionTo('Supprimer un service');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function restore(User $user, Service $service)
    {
        return $user->hasPermissionTo('Restaurer un service');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Service  $service
     * @return mixed
     */
    public function forceDelete(User $user, Service $service)
    {
        return $user->hasPermissionTo('Supprimer de force un service');
    }
}
