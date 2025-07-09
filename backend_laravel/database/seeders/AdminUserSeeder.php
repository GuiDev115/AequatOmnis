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
        $existingAdmin = User::where('email', 'admin@aequatomnis.com')->first();
        
        if (!$existingAdmin) {
            User::create([
                'name' => 'Administrador',
                'email' => 'admin@aequatomnis.com',
                'password' => 'password123',
                'administrador' => true,
            ]);
            
            $this->command->info('Usuário administrador criado com sucesso');
        } else {
            $this->command->info('Usuário administrador já existe');
        }
        
        // Também criar um usuário admin simples para compatibilidade
        $existingSimpleAdmin = User::where('email', 'admin@admin.com')->first();
        
        if (!$existingSimpleAdmin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'administrador' => true,
            ]);
            
            $this->command->info('Usuário admin simples criado com sucesso');
        }
    }
}
