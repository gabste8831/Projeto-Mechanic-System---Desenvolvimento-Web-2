<?php

namespace App\Http\Controllers;

use App\Models\Mechanic;
use Illuminate\Http\Request;

class MechanicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mechanic::query();
        
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('specialty', 'like', "%{$search}%");
        }
        
        $mechanics = $query->withCount('cars')->paginate(10);
        return view('mechanics.index', compact('mechanics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mechanics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mechanics,email',
            'phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:50',
            'is_available' => 'boolean'
        ]);

        Mechanic::create($request->all());
        return redirect()->route('mechanics.index')->with('success', 'Mecânico criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mechanic $mechanic)
    {
        $mechanic->load('cars');
        return view('mechanics.show', compact('mechanic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mechanic $mechanic)
    {
        return view('mechanics.edit', compact('mechanic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mechanic $mechanic)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:mechanics,email,' . $mechanic->id,
            'phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:50',
            'is_available' => 'boolean'
        ]);

        $mechanic->update($request->all());
        return redirect()->route('mechanics.index')->with('success', 'Mecânico atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mechanic $mechanic)
    {
        $mechanic->delete();
        return redirect()->route('mechanics.index')->with('success', 'Mecânico removido com sucesso!');
    }
}
