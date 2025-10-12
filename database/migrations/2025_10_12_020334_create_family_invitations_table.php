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
        Schema::create('family_invitations', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('token', 150)->unique();

            $table->timestamp('expires_at');
            $table->timestamp('accepted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_invitations');
    }
};
