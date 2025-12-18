<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
     use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
    ];

    /**
     * Relation : Un rôle peut avoir plusieurs utilisateurs.
     *
     * @return HasMany
     */
    public function utilisateurs(): HasMany
    {
        return $this->hasMany(User::class, 'id_role', 'id');
    }
}
