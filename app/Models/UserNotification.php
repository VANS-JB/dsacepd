<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class UserNotification extends Model
{
    use HasFactory;

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'notifications';

    /**
     * La clé primaire de la table.
     *
     * @var string
     */
    protected $primaryKey = 'id_notification';

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'message',
        'date_notification',
        'id_users',
    ];

    /**
     * Les attributs qui doivent être convertis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_notification' => 'datetime',
    ];

    /**
     * Relation : Une notification appartient à un utilisateur.
     *
     * @return BelongsTo
     */
    public function utilisateur(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

    /**
     * Alias anglais attendu par certains contrôleurs : ->with('user')
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->utilisateur();
    }
}
