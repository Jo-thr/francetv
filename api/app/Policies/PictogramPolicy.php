<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pictogram;
use Illuminate\Auth\Access\HandlesAuthorization;

class PictogramPolicy
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
        return $user->hasPermissionTo('Voir tous les pictograms');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pictogram  $pictogram
     * @return mixed
     */
    public function view(User $user, Pictogram $pictogram)
    {
        return $user->hasPermissionTo('Voir un pictogram');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Créer un pictogram');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pictogram  $pictogram
     * @return mixed
     */
    public function update(User $user, Pictogram $pictogram)
    {
        return $user->hasPermissionTo('Éditer un pictogram');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pictogram  $pictogram
     * @return mixed
     */
    public function delete(User $user, Pictogram $pictogram)
    {
        return $user->hasPermissionTo('Supprimer un pictogram');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pictogram  $pictogram
     * @return mixed
     */
    public function restore(User $user, Pictogram $pictogram)
    {
        return $user->hasPermissionTo('Restaurer un pictogram');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Pictogram  $pictogram
     * @return mixed
     */
    public function forceDelete(User $user, Pictogram $pictogram)
    {
        return $user->hasPermissionTo('Supprimer de force un pictogram');
    }
}
