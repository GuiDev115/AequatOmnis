<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingAdmin = User::where('email', 'admin')->first();
        
        if (!$existingAdmin) {
            User::create([
                'name' => 'admin',
                'email' => 'admin',
                'password' => 'admin',
                'administrador' => true,
            ]);
            
            $this->command->info('Usuário administrador criado com sucesso');
        } else {
            $this->command->info('Usuário administrador já existe');
        }
    }
}
