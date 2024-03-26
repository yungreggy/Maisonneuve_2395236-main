<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('etudiant')->paginate(10);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'langue' => 'required|in:fr,en',
            'fichier' => 'required|file|mimes:txt,pdf,doc,docx,zip|max:204800', // 200MB
        ], [
            'fichier.mimes' => 'Le type de fichier doit être txt, pdf, doc, docx ou zip.',
            'fichier.max' => 'La taille du fichier ne doit pas dépasser 200MB.',
        ]);

        $userId = auth()->id();
        $etudiant = Etudiant::where('user_id', $userId)->first();

        if (!$etudiant) {
            return back()->withErrors(['error' => 'Aucun étudiant correspondant trouvé.'])->withInput();
        }

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $nomFichier = Document::genererNomFichier($validatedData['titre'], $etudiant->id) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($nomFichier);

            Document::create([
                'titre' => $validatedData['titre'],
                'langue' => $validatedData['langue'],
                'fichier' => $path,
                'taille' => $file->getSize(),
                'etudiant_id' => $etudiant->id,

            ]);
        }

        return redirect()->back()->with('success', 'Document téléversé avec succès.');
    }



    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'langue' => 'required|in:fr,en',
            'fichier' => 'sometimes|file|mimes:txt,pdf,doc,docx,zip|max:204800',
        ]);

        $document->titre = $validatedData['titre'];
        $document->langue = $validatedData['langue'];

        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');

            $nomFichier = Document::genererNomFichier($file->getClientOriginalName(), $request->input('etudiant_id')) . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('public/documents', $nomFichier);

            $document->fichier = $path;
        }
        $document->save();

        return redirect()->route('documents.show', $id)->with('success', 'Document mis à jour avec succès.');
    }



    public function download(Document $document)
    {
        $filePath = storage_path('app/' . $document->fichier);

        if (!file_exists($filePath)) {
            abort(404, 'Le fichier n\'existe pas.');
        }


        return response()->download($filePath, $document->titre);
    }



    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Si besoin de supprimer le fichier physique du serveur, décommenter la ligne suivante :
        // Storage::disk('public')->delete($document->fichier);

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès !');
    }
}
