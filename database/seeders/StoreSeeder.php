<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $store1 = Store::create([
            'name' => 'Loja 1',
            'logo_url' => 'https://www.autoshoppingglobal.com.br/Imgs/lg/199.gif',
            'store_number' => '123 | 124',
            'email' => 'vendas@waymultimarcas.com.br',
            'phone' => 1234564545,
            'whatsapp' => 1213213123
        ]);
    }
}
