<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $query = Etudiant::with('ville')->orderBy('nom', $sort);

        if ($request->has('filter')) {
            $query->where('nom', 'like', $request->get('filter') . '%');
        }

        $etudiants = $query->paginate(50);

        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $villes = Ville::all();
        return view('etudiants.create', ['villes' => $villes]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|max:255',
            'adresse' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:users',
            'date_naissance' => 'required|date',
            'ville_nom' => 'required|string',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ville = Ville::firstOrCreate(['nom' => $request->ville_nom]);

        $user = User::create([
            'name' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id' => $ville->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('home')->with('success', 'Étudiant créé et utilisateur connecté avec succès.');
    }

    public function show($id)
    {
        $etudiant = Etudiant::with(['ville', 'articles', 'documents'])->findOrFail($id);
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $villes = Ville::all();
        return view('etudiants.edit', compact('etudiant', 'villes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:255',
            'email' => 'required|email',
            'date_naissance' => 'required|date',
            'ville_id' => 'required|exists:villes,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $etudiant = Etudiant::findOrFail($id);
        $etudiant->update($validator->validated());

        return redirect()->route('etudiants.show', $etudiant->id)->with('success', 'Étudiant mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès !');
    }
}
