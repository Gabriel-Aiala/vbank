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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('transaction_type_id')->constrained('transaction_types');
            $table->foreignId('fee_id')->nullable()->constrained('transaction_fees');

            $table->string('authentication_code')->nullable();
            $table->string('end_to_end_id')->nullable();
            $table->string('pix_key_type')->nullable();
            $table->string('pix_key')->nullable();

            $table->bigInteger('amount');
            $table->bigInteger('net_amount'); // Valor líquido após taxas
            $table->foreignUuid('from_account_id')->constrained('bank_accounts');
            $table->foreignUuid('to_account_id')->nullable()->constrained('bank_accounts');
            $table->enum('status', ['AGENDADA', 'PROCESSANDO', 'CONCLUIDA', 'CANCELADA', 'FALHA']);
            $table->dateTime('scheduled_at')->nullable();
            $table->timestamps();

            //facilitar a busca de transaçoes usando pix_key como filtro.Facilita a busca do status de uma transação pix
            $table->index(['end_to_end_id', 'status']);
            $table->index(['pix_key', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
