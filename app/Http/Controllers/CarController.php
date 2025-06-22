<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Mechanic;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Car::with('mechanic');
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('license_plate', 'like', "%{$search}%");
        }
        
        if ($request->has('status')) {
            $query->where('status', $request->get('status'));
        }
        
        $cars = $query->paginate(10);
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mechanics = Mechanic::where('is_available', true)->get();
        return view('cars.create', compact('mechanics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:cars,license_plate|max:20',
            'color' => 'required|string|max:100',
            'problem_description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
            'mechanic_id' => 'nullable|exists:mechanics,id'
        ]);

        Car::create($request->all());
        return redirect()->route('cars.index')->with('success', 'Carro registrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $car->load('mechanic');
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $mechanics = Mechanic::where('is_available', true)->get();
        return view('cars.edit', compact('car', 'mechanics'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'license_plate' => 'required|string|unique:cars,license_plate,' . $car->id . '|max:20',
            'color' => 'required|string|max:100',
            'problem_description' => 'required|string',
            'status' => 'required|in:pending,in_progress,completed',
            'mechanic_id' => 'nullable|exists:mechanics,id'
        ]);

        $car->update($request->all());
        return redirect()->route('cars.index')->with('success', 'Carro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Carro removido com sucesso!');
    }
}
