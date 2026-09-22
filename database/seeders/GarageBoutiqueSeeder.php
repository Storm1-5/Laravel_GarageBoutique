<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GarageBoutiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Joel STEPHEN',
            'email' => 'joel@user.com',
            'date_of_birth' => '2005-12-15',
            'country' => 'French Guiana',
            'is_owner' => true,
            'password' => Hash::make('lefter'), // ancien hash vide → à réinitialiser
        ]);
    }
}
