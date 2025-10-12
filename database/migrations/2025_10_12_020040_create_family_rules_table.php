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
        Schema::create('family_rules', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_rule_id')->nullable();
            $table->foreignId('family_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('family_rules');
    }
};
