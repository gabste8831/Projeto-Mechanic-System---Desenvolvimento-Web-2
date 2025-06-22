@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-mechanic-gray-900">Carros</h1>
            <p class="mt-2 text-mechanic-gray-600">Gerencie os carros da oficina</p>
        </div>
        <a href="{{ route('cars.create') }}" class="btn-primary">
            Registrar Carro
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="card">
        <form method="GET" action="{{ route('cars.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Buscar por marca, modelo ou placa..." 
                           class="form-input">
                </div>
                <div>
                    <select name="status" class="form-input">
                        <option value="">Todos os status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Concluído</option>
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="btn-secondary">
                        Buscar
                    </button>
                    @if(request('search') || request('status'))
                        <a href="{{ route('cars.index') }}" class="btn-secondary">
                            Limpar
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Cars List -->
    <div class="card">
        @if($cars->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-mechanic-gray-200">
                    <thead class="bg-mechanic-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Veículo
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Placa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Mecânico
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Registrado em
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-mechanic-gray-200">
                        @foreach($cars as $car)
                            <tr class="hover:bg-mechanic-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                                            <span class="text-mechanic-gray-600">🚗</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-mechanic-gray-900">
                                                {{ $car->brand }} {{ $car->model }}
                                            </div>
                                            <div class="text-sm text-mechanic-gray-500">
                                                {{ $car->year }} • {{ $car->color }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    {{ $car->license_plate }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($car->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($car->status === 'in_progress') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        {{ ucfirst(str_replace('_', ' ', $car->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    @if($car->mechanic)
                                        <div class="flex items-center">
                                            <div class="w-6 h-6 bg-mechanic-gray-300 rounded-full flex items-center justify-center mr-2">
                                                <span class="text-mechanic-gray-600 text-xs font-semibold">
                                                    {{ strtoupper(substr($car->mechanic->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            {{ $car->mechanic->name }}
                                        </div>
                                    @else
                                        <span class="text-mechanic-gray-400">Não atribuído</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-500">
                                    {{ $car->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('cars.show', $car) }}" class="text-mechanic-gray-600 hover:text-mechanic-gray-900">
                                        Ver
                                    </a>
                                    <a href="{{ route('cars.edit', $car) }}" class="text-blue-600 hover:text-blue-900">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('cars.destroy', $car) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                onclick="return confirm('Tem certeza que deseja remover este carro?')">
                                            Remover
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $cars->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-mechanic-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-mechanic-gray-500 text-2xl">🚗</span>
                </div>
                <h3 class="text-lg font-medium text-mechanic-gray-900 mb-2">Nenhum carro encontrado</h3>
                <p class="text-mechanic-gray-600 mb-6">
                    @if(request('search') || request('status'))
                        Nenhum carro encontrado com os critérios de busca.
                    @else
                        Comece registrando o primeiro carro na oficina.
                    @endif
                </p>
                <a href="{{ route('cars.create') }}" class="btn-primary">
                    Registrar Carro
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 