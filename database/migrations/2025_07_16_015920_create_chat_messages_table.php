<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_message', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_id');
            $table->boolean('bot_response')->default(false);
            $table->text('message');
            $table->timestamps();
            
            $table->foreign('chat_id')->references('id')->on('chat')->onDelete('cascade');
            $table->index('chat_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_message');
    }
};