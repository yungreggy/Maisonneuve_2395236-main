<?php

namespace App\Providers;
use App\Models\Article;
use App\Policies\ArticlePolicy;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider

{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        Article::class => ArticlePolicy::class,
        \App\Models\Etudiant::class => \App\Policies\EtudiantPolicy::class,
  
    
        

    ];
  
    
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
