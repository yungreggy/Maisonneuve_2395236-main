<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; 
    }

    public function create(User $user)
    {
        return true; 
    }

    public function edit(User $user, Article $article)
    {
        $etudiant = $user->etudiant; 
        return $etudiant && $etudiant->id === $article->etudiant_id; 
   
    }
    
    public function update(User $user, Article $article)
    {
        $etudiant = $user->etudiant; 
        return $etudiant && $etudiant->id === $article->etudiant_id; 
    }
    
    

    public function delete(User $user, Article $article)
    {
        $etudiant = $user->etudiant; 
        
        return $user->is_admin || ($etudiant && $etudiant->id === $article->etudiant_id);
    }
    
}
