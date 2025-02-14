<?php

namespace Database\Seeders;

use App\Models\MercadoLivreTokens;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MercadoLivreTokensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MercadoLivreTokens::create([
            "access_token" => "APP_USR-2528348058248848-021322-180f026617bacfe2e31323300963550d-222474212",
            "token_type" => "Bearer",
            "expires_in" => 21600,
            "scope" => "offline_access read write",
            "user_id" => 222474212,
            "refresh_token" => "TG-67aea60a99479400015ea25a-222474212",
        ]);
    }
}
