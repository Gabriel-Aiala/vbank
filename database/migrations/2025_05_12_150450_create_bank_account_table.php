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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id(); // Cria BIGINT PRIMARY KEY AUTO_INCREMENT
            $table->unsignedBigInteger('entity_id');
            $table->string('branch', 10);
            $table->string('account_number', 20)->unique();
            $table->unsignedBigInteger('balance')->default(0); // em centavos
            $table->timestamps();
            $table->foreign('entity_id')
                ->references('id')->on('entities')
                ->onDelete('cascade');
        });
    }
};
