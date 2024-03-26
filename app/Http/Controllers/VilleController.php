<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Afficher les villes triées par nom
        $villes = Ville::orderBy('nom', 'asc')->get();
        return view('villes.index', ['villes' => $villes]);
    }

    public function create()
    {
        return view('villes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Ville::create([
            'nom' => $request->nom,
        ]);

        return redirect()->route('villes.index')->with('success', 'Ville ajoutée avec succès !');
    }

    public function edit(Ville $ville)
    {
        return view('villes.edit', compact('ville'));
    }

    public function update(Request $request, Ville $ville)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $ville->update([
            'nom' => $request->nom,
        ]);

        return redirect()->route('villes.index')->with('success', 'Nom de la ville mis à jour avec succès.');
    }

    public function destroy(Ville $ville)
    {
        
        $ville->delete();
        return redirect()->route('villes.index')->with('success', 'Ville supprimée avec succès !');
    }
}
