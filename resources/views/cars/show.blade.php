@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-mechanic-gray-900">Detalhes do Carro</h1>
            <p class="mt-2 text-mechanic-gray-600">Informações completas do veículo</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('cars.edit', $car) }}" class="btn-primary">
                Editar
            </a>
            <a href="{{ route('cars.index') }}" class="btn-secondary">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Car Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="card">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-mechanic-gray-600 text-2xl">🚗</span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-mechanic-gray-900">{{ $car->brand }} {{ $car->model }}</h2>
                        <p class="text-mechanic-gray-600">{{ $car->license_plate }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-mechanic-gray-500 uppercase tracking-wider mb-2">
                            Informações do Veículo
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">🏭</span>
                                <span class="text-mechanic-gray-900">{{ $car->brand }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">🚙</span>
                                <span class="text-mechanic-gray-900">{{ $car->model }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📅</span>
                                <span class="text-mechanic-gray-900">{{ $car->year }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">🎨</span>
                                <span class="text-mechanic-gray-900">{{ $car->color }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-mechanic-gray-500 uppercase tracking-wider mb-2">
                            Status e Responsável
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📊</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($car->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($car->status === 'in_progress') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $car->status)) }}
                                </span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">👨‍🔧</span>
                                @if($car->mechanic)
                                    <span class="text-mechanic-gray-900">{{ $car->mechanic->name }}</span>
                                @else
                                    <span class="text-mechanic-gray-400">Não atribuído</span>
                                @endif
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📅</span>
                                <span class="text-mechanic-gray-900">Registrado em {{ $car->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Problem Description -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Descrição do Problema</h3>
                <div class="bg-mechanic-gray-50 p-4 rounded-lg">
                    <p class="text-mechanic-gray-900 whitespace-pre-wrap">{{ $car->problem_description }}</p>
                </div>
            </div>

            <!-- Mechanic Details -->
            @if($car->mechanic)
                <div class="card">
                    <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Mecânico Responsável</h3>
                    <div class="flex items-center space-x-4 p-4 bg-mechanic-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                            <span class="text-mechanic-gray-600 font-semibold">
                                {{ strtoupper(substr($car->mechanic->name, 0, 2)) }}
                            </span>
                        </div>
                        <div>
                            <h4 class="font-medium text-mechanic-gray-900">{{ $car->mechanic->name }}</h4>
                            <p class="text-sm text-mechanic-gray-600">{{ $car->mechanic->specialty }} • {{ $car->mechanic->experience_years }} anos de experiência</p>
                            <p class="text-sm text-mechanic-gray-600">{{ $car->mechanic->email }} • {{ $car->mechanic->phone }}</p>
                        </div>
                        <div class="ml-auto">
                            <a href="{{ route('mechanics.show', $car->mechanic) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                Ver perfil completo
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Status Atual</h3>
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full flex items-center justify-center
                        @if($car->status === 'pending') bg-yellow-100
                        @elseif($car->status === 'in_progress') bg-blue-100
                        @else bg-green-100
                        @endif">
                        <span class="text-2xl">
                            @if($car->status === 'pending') ⏳
                            @elseif($car->status === 'in_progress') 🔧
                            @else ✅
                            @endif
                        </span>
                    </div>
                    <h4 class="font-semibold text-mechanic-gray-900 mb-1">
                        {{ ucfirst(str_replace('_', ' ', $car->status)) }}
                    </h4>
                    <p class="text-sm text-mechanic-gray-600">
                        @if($car->status === 'pending')
                            Aguardando início do serviço
                        @elseif($car->status === 'in_progress')
                            Serviço em andamento
                        @else
                            Serviço concluído
                        @endif
                    </p>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Ações</h3>
                <div class="space-y-3">
                    <a href="{{ route('cars.edit', $car) }}" class="block w-full btn-primary text-center">
                        Editar Carro
                    </a>
                    @if(!$car->mechanic)
                        <a href="{{ route('cars.edit', $car) }}" class="block w-full btn-secondary text-center">
                            Atribuir Mecânico
                        </a>
                    @endif
                    <form method="POST" action="{{ route('cars.destroy', $car) }}" class="block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full btn-danger text-center" 
                                onclick="return confirm('Tem certeza que deseja remover este carro?')">
                            Remover Carro
                        </button>
                    </form>
                </div>
            </div>

            <!-- Timeline -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Histórico</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div>
                            <p class="text-sm font-medium text-mechanic-gray-900">Carro registrado</p>
                            <p class="text-xs text-mechanic-gray-500">{{ $car->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    @if($car->updated_at != $car->created_at)
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                            <div>
                                <p class="text-sm font-medium text-mechanic-gray-900">Informações atualizadas</p>
                                <p class="text-xs text-mechanic-gray-500">{{ $car->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 