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
        Schema::table('chat_message', function (Blueprint $table) {
            $table->enum('type', ['system', 'assistant', 'user'])
            ->default('system')
            ->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_message', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
