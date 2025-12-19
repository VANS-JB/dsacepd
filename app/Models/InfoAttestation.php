<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InfoAttestation extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'info_attestation';

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
        'nom_complet',
        'date_naissance',
        'lieu_naissance',
        'ecole',
        'numero_table',
        'session',
        'centre',
        'numero_registre',
        'id_demande',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_naissance' => 'date',
        ];
    }

    /**
     * Relation : Une info_attestation appartient à une demande.
     *
     * @return BelongsTo
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class, 'id_demande', 'id');
    }

    /**
     * Relation : Une info_attestation peut avoir une affectation.
     *
     * @return HasOne
     */
    public function affectation(): HasOne
    {
        return $this->hasOne(Affectation::class, 'id_infoattestation', 'id');
    }
}
