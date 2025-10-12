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
        Schema::create('cards', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('card_type_id');
            $table->foreignId('wallet_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('family_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('closing_day');
            $table->integer('due_day');

            $table->string('name');

            $table->decimal('balance', 10, 2);
            $table->decimal('limit', 10, 2);

            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
