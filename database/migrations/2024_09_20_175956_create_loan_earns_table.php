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
        Schema::create('loan_earns', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('reason');
            $table->decimal('loan_amount', 10, 2);
            $table->enum('type',['loan','earn']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_earns');
    }
};
