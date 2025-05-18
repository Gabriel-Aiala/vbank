<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'code' => 'PIX',
                'name' => 'Transferência PIX',
                'has_tax' => false,
                'requires_beneficiary' => true,
                'metadata' => []
            ],
            [
                'code' => 'TED',
                'name' => 'Transferência Eletrônica Disponível',
                'has_tax' => true,
                'requires_beneficiary' => true,
                'metadata' => []
            ],
            [
                'code' => 'DOC',
                'name' => 'Documento de Ordem de Crédito',
                'has_tax' => true,
                'requires_beneficiary' => true,
                'metadata' => []
            ],
            [
                'code' => 'SAQUE',
                'name' => 'Saque em Dinheiro',
                'has_tax' => false,
                'requires_beneficiary' => false,
                'metadata' => []
            ],
            [
                'code' => 'BOLETO',
                'name' => 'Pagamento de Boleto',
                'has_tax' => false,
                'requires_beneficiary' => true,
                'metadata' => []
            ],
            [
                'code' => 'DEBITO',
                'name' => 'Cartão de Débito',
                'has_tax' => false,
                'requires_beneficiary' => false,
                'metadata' => []
            ]
        ];

        foreach ($types as $type) {
            DB::table('transaction_types')->insert([
                'code' => $type['code'],
                'name' => $type['name'],
                'has_tax' => $type['has_tax'],
                'requires_beneficiary' => $type['requires_beneficiary'],
                'metadata' => json_encode($type['metadata']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
