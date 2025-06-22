<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mechanic;

class MechanicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mechanics = [
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@oficina.com',
                'phone' => '(11) 99999-1111',
                'specialty' => 'Motor',
                'experience_years' => 8,
                'is_available' => true,
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@oficina.com',
                'phone' => '(11) 99999-2222',
                'specialty' => 'Elétrica',
                'experience_years' => 5,
                'is_available' => true,
            ],
            [
                'name' => 'Pedro Oliveira',
                'email' => 'pedro.oliveira@oficina.com',
                'phone' => '(11) 99999-3333',
                'specialty' => 'Suspensão',
                'experience_years' => 12,
                'is_available' => true,
            ],
            [
                'name' => 'Ana Costa',
                'email' => 'ana.costa@oficina.com',
                'phone' => '(11) 99999-4444',
                'specialty' => 'Freios',
                'experience_years' => 6,
                'is_available' => false,
            ],
            [
                'name' => 'Carlos Ferreira',
                'email' => 'carlos.ferreira@oficina.com',
                'phone' => '(11) 99999-5555',
                'specialty' => 'Geral',
                'experience_years' => 15,
                'is_available' => true,
            ],
        ];

        foreach ($mechanics as $mechanic) {
            Mechanic::create($mechanic);
        }
    }
}
