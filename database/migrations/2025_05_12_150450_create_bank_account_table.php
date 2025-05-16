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
        Schema::create('bank_account', function (Blueprint $table) {
            $table->id(); // Cria BIGINT PRIMARY KEY AUTO_INCREMENT
            $table->unsignedBigInteger('entity_id');
            $table->string('branch', 10);
            $table->string('account_number', 20);
            $table->decimal('balance', 15, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('entity_id')
                ->references('id')->on('entities')
                ->onDelete('cascade');
        });
    }
};
