<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition()
    {
        static $etudiants = null;

        if ($etudiants === null) {
            $etudiants = Etudiant::inRandomOrder()->take(20)->get()->pluck('id')->toArray();
        }

        return [
            'titre' => $this->faker->sentence,
            'contenu' => $this->faker->text(200),
            'date_publication' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'langue' => $this->faker->randomElement(['fr', 'en']),
            'etudiant_id' => $this->faker->randomElement($etudiants),
        ];
    }
}


