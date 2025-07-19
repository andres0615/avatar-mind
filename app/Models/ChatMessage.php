<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
USE Illuminate\Support\Facades\Log;

class ChatMessage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chat_message';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chat_id',
        'bot_response',
        'message',
        'time_ago',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'bot_response' => 'boolean',
    ];

    protected $appends = ['time_ago']; // Para que aparezca en toArray()/toJson()

    // =================================
    // RELACIONES
    // =================================

    /**
     * Get the chat that owns the message.
     */
    public function chat(): BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }

    public function isBotResponse(): bool
    {
        return $this->bot_response;
    }

    public function storeUserMessage($chatId, $requestData)
    {
        // Crear el nuevo mensaje de chat del usuario
        $newMessage = self::create([
            'chat_id' => $chatId,
            'message' => $requestData['message'],
        ]);

        $botResponse = $this->generateBotResponse($chatId, $requestData['message']);

        $responseData = [
            'success' => true,
            'message' => 'Mensaje creado exitosamente',
            'data' => [
                'userMessage' => $newMessage,
                'botResponse' => $botResponse,
            ], // Cargar la relación chat si es necesario
        ];

        return $responseData;
    }

    public function generateBotResponse($chatId, $message)
    {
        // Aquí puedes implementar la lógica para generar una respuesta del bot
        // Por ejemplo, usando una API de IA o lógica personalizada
        $botResponse = "Hola ya recibi tu mensaje"; // Placeholder

        $botMessage = $this->storeBotResponse($chatId, $botResponse);

        return $botMessage;
    }

    public function storeBotResponse($chatId, $message)
    {
        // Crear el nuevo mensaje de respuesta del bot
        $botMessage = self::create([
            'chat_id' => $chatId,
            'bot_response' => true,
            'message' => $message,
        ]);
        
        return $botMessage;
    }

    // =================================
    // ACCESSORS
    // =================================

    public function getTimeAgoAttribute(): string
    {
        $now = new \DateTime();
        $messageDate = new \DateTime($this->created_at);
        $messageAgo = $now->diff($messageDate);
        // Log::info(json_encode($messageAgo));

        if ($messageAgo->y > 0) {
            $unit = ($messageAgo->y > 1) ? 'años' : 'año';
            $messageAgo = 'hace ' . $messageAgo->y . ' ' . $unit;
        } elseif ($messageAgo->m > 0) {
            $unit = ($messageAgo->m > 1) ? 'meses' : 'mes';
            $messageAgo = 'hace ' . $messageAgo->m . ' ' . $unit;
        } elseif ($messageAgo->d > 0) {
            $unit = ($messageAgo->d > 1) ? 'días' : 'día';
            $messageAgo = 'hace ' . $messageAgo->d . ' ' . $unit;
        } elseif ($messageAgo->h > 0) {
            $unit = ($messageAgo->h > 1) ? 'horas' : 'hora';
            $messageAgo = 'hace ' . $messageAgo->h . ' ' . $unit;
        } elseif ($messageAgo->i > 0) {
            $unit = ($messageAgo->i > 1) ? 'minutos' : 'minuto';
            $messageAgo = 'hace ' . $messageAgo->i . ' ' . $unit;
        } else {
            $messageAgo = "justo ahora";
        }

        return $messageAgo;
    }
}