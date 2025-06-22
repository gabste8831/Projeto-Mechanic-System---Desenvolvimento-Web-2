@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-mechanic-gray-900">Editar Carro</h1>
                <p class="mt-2 text-mechanic-gray-600">Atualize as informações do carro</p>
            </div>
            <a href="{{ route('cars.index') }}" class="btn-secondary">
                Voltar
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form method="POST" action="{{ route('cars.update', $car) }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Brand and Model -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" 
                                   class="form-input @error('brand') border-red-500 @enderror" required>
                            @error('brand')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="model" class="form-label">Modelo</label>
                            <input type="text" id="model" name="model" value="{{ old('model', $car->model) }}" 
                                   class="form-input @error('model') border-red-500 @enderror" required>
                            @error('model')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Year and License Plate -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="year" class="form-label">Ano</label>
                            <input type="number" id="year" name="year" value="{{ old('year', $car->year) }}" 
                                   min="1900" max="{{ date('Y') + 1 }}"
                                   class="form-input @error('year') border-red-500 @enderror" required>
                            @error('year')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="license_plate" class="form-label">Placa</label>
                            <input type="text" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" 
                                   class="form-input @error('license_plate') border-red-500 @enderror" required>
                            @error('license_plate')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Color -->
                    <div>
                        <label for="color" class="form-label">Cor</label>
                        <input type="text" id="color" name="color" value="{{ old('color', $car->color) }}" 
                               class="form-input @error('color') border-red-500 @enderror" required>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Problem Description -->
                    <div>
                        <label for="problem_description" class="form-label">Descrição do Problema</label>
                        <textarea id="problem_description" name="problem_description" rows="4" 
                                  class="form-input @error('problem_description') border-red-500 @enderror" required>{{ old('problem_description', $car->problem_description) }}</textarea>
                        @error('problem_description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status and Mechanic -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" 
                                    class="form-input @error('status') border-red-500 @enderror" required>
                                <option value="">Selecione o status</option>
                                <option value="pending" {{ old('status', $car->status) == 'pending' ? 'selected' : '' }}>Pendente</option>
                                <option value="in_progress" {{ old('status', $car->status) == 'in_progress' ? 'selected' : '' }}>Em Andamento</option>
                                <option value="completed" {{ old('status', $car->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="mechanic_id" class="form-label">Mecânico Responsável</label>
                            <select id="mechanic_id" name="mechanic_id" 
                                    class="form-input @error('mechanic_id') border-red-500 @enderror">
                                <option value="">Selecione um mecânico (opcional)</option>
                                @foreach($mechanics as $mechanic)
                                    <option value="{{ $mechanic->id }}" {{ old('mechanic_id', $car->mechanic_id) == $mechanic->id ? 'selected' : '' }}>
                                        {{ $mechanic->name }} - {{ $mechanic->specialty }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mechanic_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-mechanic-gray-200">
                        <a href="{{ route('cars.index') }}" class="btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-primary">
                            Atualizar Carro
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 