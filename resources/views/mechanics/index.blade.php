@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-mechanic-gray-900">Mecânicos</h1>
            <p class="mt-2 text-mechanic-gray-600">Gerencie os mecânicos da oficina</p>
        </div>
        <a href="{{ route('mechanics.create') }}" class="btn-primary">
            Adicionar Mecânico
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="card">
        <form method="GET" action="{{ route('mechanics.index') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Buscar por nome, email ou especialidade..." 
                       class="form-input">
            </div>
            <button type="submit" class="btn-secondary">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('mechanics.index') }}" class="btn-secondary">
                    Limpar
                </a>
            @endif
        </form>
    </div>

    <!-- Mechanics List -->
    <div class="card">
        @if($mechanics->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-mechanic-gray-200">
                    <thead class="bg-mechanic-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Especialidade
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Experiência
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Carros
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-mechanic-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-mechanic-gray-200">
                        @foreach($mechanics as $mechanic)
                            <tr class="hover:bg-mechanic-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-mechanic-gray-300 rounded-full flex items-center justify-center">
                                            <span class="text-mechanic-gray-600 font-semibold">
                                                {{ strtoupper(substr($mechanic->name, 0, 2)) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-mechanic-gray-900">
                                                {{ $mechanic->name }}
                                            </div>
                                            <div class="text-sm text-mechanic-gray-500">
                                                {{ $mechanic->phone }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    {{ $mechanic->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    {{ $mechanic->specialty }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    {{ $mechanic->experience_years }} anos
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        @if($mechanic->is_available) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                        {{ $mechanic->is_available ? 'Disponível' : 'Indisponível' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-mechanic-gray-900">
                                    {{ $mechanic->cars_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('mechanics.show', $mechanic) }}" class="text-mechanic-gray-600 hover:text-mechanic-gray-900">
                                        Ver
                                    </a>
                                    <a href="{{ route('mechanics.edit', $mechanic) }}" class="text-blue-600 hover:text-blue-900">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route('mechanics.destroy', $mechanic) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" 
                                                onclick="return confirm('Tem certeza que deseja remover este mecânico?')">
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
                {{ $mechanics->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-mechanic-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-mechanic-gray-500 text-2xl">👨‍🔧</span>
                </div>
                <h3 class="text-lg font-medium text-mechanic-gray-900 mb-2">Nenhum mecânico encontrado</h3>
                <p class="text-mechanic-gray-600 mb-6">
                    @if(request('search'))
                        Nenhum mecânico encontrado com os critérios de busca.
                    @else
                        Comece adicionando o primeiro mecânico à oficina.
                    @endif
                </p>
                <a href="{{ route('mechanics.create') }}" class="btn-primary">
                    Adicionar Mecânico
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 