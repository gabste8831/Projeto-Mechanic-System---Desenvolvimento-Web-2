@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-mechanic-gray-900">Detalhes do Mecânico</h1>
            <p class="mt-2 text-mechanic-gray-600">Informações completas do mecânico</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('mechanics.edit', $mechanic) }}" class="btn-primary">
                Editar
            </a>
            <a href="{{ route('mechanics.index') }}" class="btn-secondary">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Mechanic Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Info Card -->
            <div class="card">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="w-16 h-16 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                        <span class="text-mechanic-gray-600 text-2xl font-bold">
                            {{ strtoupper(substr($mechanic->name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-mechanic-gray-900">{{ $mechanic->name }}</h2>
                        <p class="text-mechanic-gray-600">{{ $mechanic->specialty }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-mechanic-gray-500 uppercase tracking-wider mb-2">
                            Informações de Contato
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📧</span>
                                <span class="text-mechanic-gray-900">{{ $mechanic->email }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📞</span>
                                <span class="text-mechanic-gray-900">{{ $mechanic->phone }}</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-mechanic-gray-500 uppercase tracking-wider mb-2">
                            Informações Profissionais
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">👨‍🔧</span>
                                <span class="text-mechanic-gray-900">{{ $mechanic->specialty }}</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">⏰</span>
                                <span class="text-mechanic-gray-900">{{ $mechanic->experience_years }} anos de experiência</span>
                            </div>
                            <div class="flex items-center">
                                <span class="text-mechanic-gray-400 mr-2">📊</span>
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($mechanic->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $mechanic->is_available ? 'Disponível' : 'Indisponível' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cars Assigned -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Carros Atribuídos</h3>
                
                @if($mechanic->cars->count() > 0)
                    <div class="space-y-4">
                        @foreach($mechanic->cars as $car)
                            <div class="flex items-center justify-between p-4 bg-mechanic-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                                        <span class="text-mechanic-gray-600">🚗</span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-mechanic-gray-900">{{ $car->brand }} {{ $car->model }}</p>
                                        <p class="text-sm text-mechanic-gray-600">{{ $car->license_plate }} • {{ $car->year }}</p>
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
                                    <a href="{{ route('cars.show', $car) }}" class="block text-sm text-blue-600 hover:text-blue-900 mt-1">
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <div class="w-12 h-12 bg-mechanic-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-mechanic-gray-500">🚗</span>
                        </div>
                        <p class="text-mechanic-gray-500">Nenhum carro atribuído a este mecânico.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Stats -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Estatísticas</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-mechanic-gray-600">Total de Carros</span>
                        <span class="font-semibold text-mechanic-gray-900">{{ $mechanic->cars->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-mechanic-gray-600">Em Andamento</span>
                        <span class="font-semibold text-blue-600">{{ $mechanic->cars->where('status', 'in_progress')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-mechanic-gray-600">Concluídos</span>
                        <span class="font-semibold text-green-600">{{ $mechanic->cars->where('status', 'completed')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-mechanic-gray-600">Pendentes</span>
                        <span class="font-semibold text-yellow-600">{{ $mechanic->cars->where('status', 'pending')->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="card">
                <h3 class="text-lg font-semibold text-mechanic-gray-900 mb-4">Ações</h3>
                <div class="space-y-3">
                    <a href="{{ route('cars.create') }}" class="block w-full btn-primary text-center">
                        Atribuir Carro
                    </a>
                    <a href="{{ route('mechanics.edit', $mechanic) }}" class="block w-full btn-secondary text-center">
                        Editar Mecânico
                    </a>
                    <form method="POST" action="{{ route('mechanics.destroy', $mechanic) }}" class="block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="block w-full btn-danger text-center" 
                                onclick="return confirm('Tem certeza que deseja remover este mecânico?')">
                            Remover Mecânico
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 