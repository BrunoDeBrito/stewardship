<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('installments', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('card_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('transaction_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('number_installments');
            $table->decimal('value', 10, 2);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
