<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\saved_land_plots;
use App\Models\User;

class SavedLandPlotsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, saved_land_plots $savedLandPlots): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, saved_land_plots $savedLandPlots): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, saved_land_plots $savedLandPlots): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, saved_land_plots $savedLandPlots): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, saved_land_plots $savedLandPlots): bool
    {
        return false;
    }
}
