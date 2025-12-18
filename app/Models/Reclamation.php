<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Reclamation extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'reclamations';

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
        'objet',
        'message',
        'id_demande',
    ];

    /**
     * Relation : Une réclamation appartient à une demande.
     *
     * @return BelongsTo
     */
    public function demande(): BelongsTo
    {
        return $this->belongsTo(Demande::class, 'id_demande', 'id');
    }
}
