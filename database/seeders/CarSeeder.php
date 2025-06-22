<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Mechanic;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mechanics = Mechanic::all();

        $cars = [
            [
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => 2020,
                'license_plate' => 'ABC-1234',
                'color' => 'Prata',
                'problem_description' => 'Problema no sistema de ar condicionado. Não está resfriando adequadamente.',
                'status' => 'in_progress',
                'mechanic_id' => $mechanics->where('specialty', 'Geral')->first()->id,
            ],
            [
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => 2019,
                'license_plate' => 'DEF-5678',
                'color' => 'Preto',
                'problem_description' => 'Barulho estranho no motor. Possível problema na correia dentada.',
                'status' => 'pending',
                'mechanic_id' => $mechanics->where('specialty', 'Motor')->first()->id,
            ],
            [
                'brand' => 'Volkswagen',
                'model' => 'Golf',
                'year' => 2021,
                'license_plate' => 'GHI-9012',
                'color' => 'Branco',
                'problem_description' => 'Problemas elétricos. Luzes do painel não acendem.',
                'status' => 'completed',
                'mechanic_id' => $mechanics->where('specialty', 'Elétrica')->first()->id,
            ],
            [
                'brand' => 'Ford',
                'model' => 'Focus',
                'year' => 2018,
                'license_plate' => 'JKL-3456',
                'color' => 'Azul',
                'problem_description' => 'Suspensão com barulho. Amortecedores precisam ser verificados.',
                'status' => 'in_progress',
                'mechanic_id' => $mechanics->where('specialty', 'Suspensão')->first()->id,
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Onix',
                'year' => 2022,
                'license_plate' => 'MNO-7890',
                'color' => 'Vermelho',
                'problem_description' => 'Freios com ruído. Pastilhas de freio desgastadas.',
                'status' => 'pending',
                'mechanic_id' => null,
            ],
            [
                'brand' => 'Hyundai',
                'model' => 'HB20',
                'year' => 2020,
                'license_plate' => 'PQR-1234',
                'color' => 'Cinza',
                'problem_description' => 'Problema no sistema de injeção. Motor falhando.',
                'status' => 'completed',
                'mechanic_id' => $mechanics->where('specialty', 'Motor')->first()->id,
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
