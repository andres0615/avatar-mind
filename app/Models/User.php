<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Character;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the characters for the user.
     */
    public function characters(): HasMany
    {
        return $this->hasMany(Character::class);
    }

    
    // Obtener el ultimo mensaje del chat, atravez de la relación con el modelo Character y de la relación con el modelo Chat, y de la relación con el modelo ChatMessage
    // public function lastMessage(): HasMany
    // {
    //     return $this->hasManyThrough(
    //         ChatMessage::class,
    //         Character::class,
    //         'user_id', // Foreign key on characters table
    //         'character_id', // Foreign key on chat_messages table
    //         'id', // Local key on users table
    //         'id' // Local key on characters table
    //     )->latest();
    // }




    // public function lastMessage(): BelongsTo
    // {
    //     return $this->hasOneThrough(
    //         ChatMessage::class,
    //         Chat::class,
    //         'character_id', // Foreign key on chats table
    //         'chat_id', // Foreign key on chat_messages table
    //         'id', // Local key on characters table
    //         'id' // Local key on chats table
    //     )->latest();
    // }

    // public function chats(): HasManyThrough
    // {
    //     // Obtener los chats atravez de la relación con el modelo Character
    //     return $this->hasManyThrough(Chat::class, Character::class);
    //     // return $this->hasMany(Chat::class);
    // }
}
