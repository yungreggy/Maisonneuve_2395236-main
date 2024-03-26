<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): bool
{
    return true;
}

public function view(User $user, Etudiant $etudiant): bool
{
    return $user->is_admin;
}


public function update(User $user, User $model): bool
{
    return  $user->is_admin ;
}

public function delete(User $user, User $model): bool
{
    return $user->is_admin && $user->id !== $model->id;
}

}
