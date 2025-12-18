<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Demande extends Model
{
     use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'demandes';

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
        'photo_releve',
        'photo_naissance',
        'id_users',
        'date_demande',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_demande' => 'datetime',
        ];
    }

    /**
     * Relation : Une demande appartient à un utilisateur.
     *
     * @return BelongsTo
     */
    // public function utilisateur(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'id_users', 'id');
    // }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

   

    /**
     * Relation : Une demande peut avoir une réclamation.
     *
     * @return HasOne
     */
    public function reclamation(): HasOne
    {
        return $this->hasOne(Reclamation::class, 'id_demande', 'id');
    }

    /**
     * Relation : Une demande peut avoir une info_attestation.
     *
     * @return HasOne
     */
    public function infoAttestation(): HasOne
    {
        return $this->hasOne(InfoAttestation::class, 'id_demande', 'id');
    }

    /**
     * Relation : Une demande peut avoir plusieurs affectations (historique).
     *
     * @return HasMany
     */
    public function affectations(): HasMany
    {
        return $this->hasMany(Affectation::class, 'id_infoattestation', 'id')
                    ->through('infoAttestation');
    }

    /**
     * Vérifie si la demande a déjà une info_attestation.
     *
     * @return bool
     */
    public function hasInfoAttestation(): bool
    {
        return $this->infoAttestation()->exists();
    }
}
