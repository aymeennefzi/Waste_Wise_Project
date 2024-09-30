<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RecyclingCenter;

class RecyclingCenterPolicy
{
    /**
     * Determine whether the user can view any recycling centers.
     */
    public function manage(User $user)
    {
        return $user->utype === 'ADMIN';
    }
    public function viewAny(User $user)
    {
        return true; // Tout le monde peut voir la liste des centres.
    }

    /**
     * Determine whether the user can view the recycling center.
     */
    public function view(User $user, RecyclingCenter $center)
    {
        return true; // Tout le monde peut voir un centre spécifique.
    }

    /**
     * Determine whether the user can create a recycling center.
     */
    public function create(User $user)
    {
        // Seuls les utilisateurs de type ADMIN peuvent créer un centre.
        return $user->utype === 'ADMIN';
    }

    /**
     * Determine whether the user can update the recycling center.
     */
    public function update(User $user, RecyclingCenter $center)
    {
        // Seuls les utilisateurs de type ADMIN peuvent mettre à jour un centre.
        return $user->utype === 'ADMIN';
    }

    /**
     * Determine whether the user can delete the recycling center.
     */
    public function delete(User $user, RecyclingCenter $center)
    {
        // Seuls les utilisateurs de type ADMIN peuvent supprimer un centre.
        return $user->utype === 'ADMIN';
    }

    /**
     * Determine whether the user can restore the recycling center.
     */
    public function restore(User $user, RecyclingCenter $center)
    {
        return $user->utype === 'ADMIN';
    }

    /**
     * Determine whether the user can permanently delete the recycling center.
     */
    public function forceDelete(User $user, RecyclingCenter $center)
    {
        return $user->utype === 'ADMIN';
    }
}
