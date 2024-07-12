<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tg_messages', static function (Blueprint $table): void {
            $table->unsignedBigInteger('message_id')->primary();
            $table->unsignedBigInteger('from_id')->nullable();
            $table->unsignedBigInteger('chat_id')->nullable();
            $table->text('text')->nullable()->index();
            $table->timestamp('date')->index();
            $table->json('data');
            $table->timestamps();

            $table->foreign('from_id')->references('user_id')->on('tg_users');
            $table->foreign('chat_id')->references('chat_id')->on('tg_chats');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tg_messages');
    }
};
