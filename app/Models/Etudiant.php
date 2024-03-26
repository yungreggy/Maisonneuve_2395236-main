<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'date_naissance',
        'ville_id',
        'user_id' // Assure-toi d'inclure tous les champs que tu souhaites pouvoir assigner massivement
    ];

    // Si tu as besoin de définir explicitement le nom de la table
    protected $table = 'etudiants'; // Remplace par le vrai nom de ta table si différent

    // Relations
    // Exemple: si un étudiant appartient à une ville
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    // Si un étudiant est associé à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Relation avec les articles
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Ajoute ici d'autres méthodes si nécessaire, comme des scopes ou des attributs personnalisés
}
