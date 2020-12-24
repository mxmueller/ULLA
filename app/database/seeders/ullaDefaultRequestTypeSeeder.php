<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Request_type;
class ullaDefaultRequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paid = Request_type::create([
            'request_type' => 'paid',
            'description' => 'Bezahlter Urlaub'
        ]);

        $unpaid = Request_type::create([
            'request_type' => 'unpaid',
            'description' => 'Unbezahlter Urlaub (Sonderurlaub)'
        ]);
    }
}
