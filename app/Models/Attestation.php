<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Attestation extends Model
{
     use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'attestations';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_attestation';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_infoattestation',
        'fichier_pdf',
        'date_generation',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date_generation' => 'datetime',
        ];
    }

    /**
     * Relation : Une affectation appartient à une info_attestation.
     *
     * @return BelongsTo
     */
    public function infoAttestation(): BelongsTo
    {
        return $this->belongsTo(InfoAttestation::class, 'id_infoattestation', 'id');
    }

    /**
     * Relation indirecte : Accéder à la demande via info_attestation.
     *
     * @return BelongsTo
     */
    public function demande(): BelongsTo
    {
        return $this->infoAttestation->demande();
    }
}
