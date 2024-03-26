<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class EtudiantPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Etudiant $etudiant): bool
    {
        
        return Auth::check();
    }


}






