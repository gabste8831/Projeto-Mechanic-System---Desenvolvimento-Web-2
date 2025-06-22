@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="text-center">
        <h1 class="text-3xl font-bold text-mechanic-gray-900">Dashboard</h1>
        <p class="mt-2 text-mechanic-gray-600">Sistema de Gerenciamento de Mecânicos e Carros</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Mecânicos -->
        <div class="card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-mechanic-gray-600 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">👨‍🔧</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-mechanic-gray-600">Total Mecânicos</p>
                    <p class="text-2xl font-semibold text-mechanic-gray-900">{{ $totalMechanics }}</p>
                </div>
            </div>
        </div>

        <!-- Total Carros -->
        <div class="card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-mechanic-gray-600 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">🚗</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-mechanic-gray-600">Total Carros</p>
                    <p class="text-2xl font-semibold text-mechanic-gray-900">{{ $totalCars }}</p>
                </div>
            </div>
        </div>

        <!-- Carros Pendentes -->
        <div class="card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">⏳</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-mechanic-gray-600">Pendentes</p>
                    <p class="text-2xl font-semibold text-mechanic-gray-900">{{ $pendingCars }}</p>
                </div>
            </div>
        </div>

        <!-- Carros Concluídos -->
        <div class="card">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                        <span class="text-white text-lg">✅</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-mechanic-gray-600">Concluídos</p>
                    <p class="text-2xl font-semibold text-mechanic-gray-900">{{ $completedCars }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card">
            <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Ações Rápidas</h3>
            <div class="space-y-3">
                <a href="{{ route('mechanics.create') }}" class="block w-full btn-primary text-center">
                    Adicionar Mecânico
                </a>
                <a href="{{ route('cars.create') }}" class="block w-full btn-secondary text-center">
                    Registrar Carro
                </a>
            </div>
        </div>

        <div class="card">
            <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Navegação</h3>
            <div class="space-y-3">
                <a href="{{ route('mechanics.index') }}" class="block w-full btn-secondary text-center">
                    Ver Todos os Mecânicos
                </a>
                <a href="{{ route('cars.index') }}" class="block w-full btn-secondary text-center">
                    Ver Todos os Carros
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card">
        <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Atividade Recente</h3>
        <div class="space-y-4">
            @php
                $recentCars = \App\Models\Car::with('mechanic')->latest()->take(5)->get();
            @endphp
            
            @forelse($recentCars as $car)
                <div class="flex items-center justify-between p-4 bg-mechanic-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-mechanic-gray-600">🚗</span>
                        </div>
                        <div>
                            <p class="font-medium text-mechanic-gray-900">{{ $car->brand }} {{ $car->model }}</p>
                            <p class="text-sm text-mechanic-gray-600">{{ $car->license_plate }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if($car->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($car->status === 'in_progress') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $car->status)) }}
                        </span>
                        @if($car->mechanic)
                            <p class="text-sm text-mechanic-gray-600 mt-1">{{ $car->mechanic->name }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-mechanic-gray-500 text-center py-4">Nenhum carro registrado ainda.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection 