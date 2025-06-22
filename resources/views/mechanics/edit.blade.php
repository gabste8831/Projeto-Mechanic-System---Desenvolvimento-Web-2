@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-mechanic-gray-900">Editar Mecânico</h1>
                <p class="mt-2 text-mechanic-gray-600">Atualize as informações do mecânico</p>
            </div>
            <a href="{{ route('mechanics.index') }}" class="btn-secondary">
                Voltar
            </a>
        </div>

        <!-- Form -->
        <div class="card">
            <form method="POST" action="{{ route('mechanics.update', $mechanic) }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $mechanic->name) }}" 
                               class="form-input @error('name') border-red-500 @enderror" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $mechanic->email) }}" 
                               class="form-input @error('email') border-red-500 @enderror" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="form-label">Telefone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $mechanic->phone) }}" 
                               class="form-input @error('phone') border-red-500 @enderror" required>
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Specialty -->
                    <div>
                        <label for="specialty" class="form-label">Especialidade</label>
                        <select id="specialty" name="specialty" 
                                class="form-input @error('specialty') border-red-500 @enderror" required>
                            <option value="">Selecione uma especialidade</option>
                            <option value="Motor" {{ old('specialty', $mechanic->specialty) == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Suspensão" {{ old('specialty', $mechanic->specialty) == 'Suspensão' ? 'selected' : '' }}>Suspensão</option>
                            <option value="Freios" {{ old('specialty', $mechanic->specialty) == 'Freios' ? 'selected' : '' }}>Freios</option>
                            <option value="Elétrica" {{ old('specialty', $mechanic->specialty) == 'Elétrica' ? 'selected' : '' }}>Elétrica</option>
                            <option value="Ar Condicionado" {{ old('specialty', $mechanic->specialty) == 'Ar Condicionado' ? 'selected' : '' }}>Ar Condicionado</option>
                            <option value="Transmissão" {{ old('specialty', $mechanic->specialty) == 'Transmissão' ? 'selected' : '' }}>Transmissão</option>
                            <option value="Geral" {{ old('specialty', $mechanic->specialty) == 'Geral' ? 'selected' : '' }}>Geral</option>
                        </select>
                        @error('specialty')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Experience Years -->
                    <div>
                        <label for="experience_years" class="form-label">Anos de Experiência</label>
                        <input type="number" id="experience_years" name="experience_years" 
                               value="{{ old('experience_years', $mechanic->experience_years) }}" min="0" max="50"
                               class="form-input @error('experience_years') border-red-500 @enderror" required>
                        @error('experience_years')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Available -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_available" name="is_available" value="1" 
                               {{ old('is_available', $mechanic->is_available) ? 'checked' : '' }}
                               class="h-4 w-4 text-mechanic-gray-600 focus:ring-mechanic-gray-500 border-mechanic-gray-300 rounded">
                        <label for="is_available" class="ml-2 block text-sm text-mechanic-gray-900">
                            Disponível para trabalho
                        </label>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-mechanic-gray-200">
                        <a href="{{ route('mechanics.index') }}" class="btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn-primary">
                            Atualizar Mecânico
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 