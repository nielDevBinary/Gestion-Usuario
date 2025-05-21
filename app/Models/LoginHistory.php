<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * LoginHistory
 * historial de inicio de sesión de los usuarios.
 */
class LoginHistory extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'logged_in_at', 'ip_address'];
    
    /**
     * user
     * relacion inversa
     * este historial pertenece a un usuario
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
