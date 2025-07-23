<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Services\GroqService;

class Character extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'tagline',
        'visibility',
        'personality_description',
        'age',
        'occupation',
        'interests',
        'creativity_level',
        'response_length',
        'user_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'interests' => 'array', // Convierte JSON a array automáticamente
        'creativity_level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // Agregar campos que no quieras mostrar en JSON si es necesario
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'interests' => 'array',
            'creativity_level' => 'integer',
        ];
    }

    protected $appends = ['max_tokens', 'temperature'];

    // =================================
    // RELACIONES
    // =================================

    /**
     * Get the user that owns the character.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the chats for the character.
     */
    public function chat(): HasOne
    {
        return $this->hasOne(Chat::class);
    }

    // =================================
    // SCOPES (Consultas predefinidas)
    // =================================

    /**
     * Scope para obtener solo personajes públicos
     */
    public function scopePublic($query)
    {
        return $query->where('visibility', 'public');
    }

    /**
     * Scope para obtener personajes por categoría
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope para obtener personajes del usuario actual
     */
    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // =================================
    // ACCESSORS (Modificadores de salida)
    // =================================

    /**
     * Get the character's formatted age.
     */
    public function getFormattedAgeAttribute(): string
    {
        return $this->age ?? 'No especificada';
    }

    /**
     * Get the character's interests as comma-separated string.
     */
    public function getInterestsStringAttribute(): string
    {
        if (!$this->interests || empty($this->interests)) {
            return 'Sin intereses definidos';
        }
        
        return implode(', ', $this->interests);
    }

    public function getMaxTokensAttribute(): int
    {
        switch ($this->response_length) {
            case 'short':
                return 100; // Máximo tokens para respuestas cortas
            case 'medium':
                return 200; // Máximo tokens para respuestas medianas
            case 'long':
                return 300; // Máximo tokens para respuestas largas
            default:
                return 200; // Valor por defecto si no se especifica
        }
    }

    public function getTemperatureAttribute(): int
    {
        return $this->creativity_level / 5;
    }

    // =================================
    // MUTATORS (Modificadores de entrada)
    // =================================

    /**
     * Set the character's name (capitalize first letter).
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = ucfirst(trim($value));
    }

    /**
     * Set the creativity level (ensure it's within bounds).
     */
    public function setCreativityLevelAttribute($value): void
    {
        $this->attributes['creativity_level'] = max(1, min(10, (int) $value));
    }

    // =================================
    // MÉTODOS AUXILIARES
    // =================================

    /**
     * Check if the character is public.
     */
    public function isPublic(): bool
    {
        return $this->visibility === 'public';
    }

    /**
     * Check if the character is private.
     */
    public function isPrivate(): bool
    {
        return $this->visibility === 'private';
    }

    /**
     * Check if the character is visible to friends only.
     */
    public function isFriendsOnly(): bool
    {
        return $this->visibility === 'friends';
    }

    /**
     * Check if user can view this character.
     */
    public function canBeViewedBy(?User $user): bool
    {
        // Si es público, cualquiera puede verlo
        if ($this->isPublic()) {
            return true;
        }

        // Si no hay usuario logueado, solo puede ver públicos
        if (!$user) {
            return false;
        }

        // Si es el dueño, siempre puede verlo
        if ($this->user_id === $user->id) {
            return true;
        }

        // Si es solo para amigos, aquí podrías implementar lógica de amistad
        if ($this->isFriendsOnly()) {
            // TODO: Implementar lógica de amistad
            return false;
        }

        return false;
    }
}