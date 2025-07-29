<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Chat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chat';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'character_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime:H:i',
        'updated_at' => 'datetime',
    ];

    // =================================
    // RELACIONES
    // =================================

    /**
     * Get the character that owns the chat.
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the messages for the chat.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class);
    }

    // Obtener el último mensaje del chat
    public function lastMessage()
    {
        return $this->hasOne(ChatMessage::class)->latestOfMany();
        // ->latestOfMany()
        // ->select(['*'])
        // // Calcular el tiempo transcurrido desde el último mensaje
        // ->selectRaw("TIMESTAMPDIFF(SECOND, created_at, NOW()) as time_ago");
    }

    public function lastSystemMessage()
    {
        return $this->messages()->system()->latest()->first();
    }
}