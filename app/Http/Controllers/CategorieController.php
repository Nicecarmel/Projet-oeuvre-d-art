<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Categorie::create($validated);

        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès');
    }


    public function show(Categorie $categorie)
    {

        $oeuvres = $categorie->oeuvres;

        return view('categories.show', compact('category', 'artworks'));
    }


    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }


    public function update(Request $request, Categorie $categorie)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$categorie->id,
        ]);

        $categorie->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie mise à jour avec succès');
    }


    public function destroy(Categorie $categorie)
    {
        // Vérifier si la catégorie contient des œuvres avant de supprimer
        if ($categorie->oeuvres()->count() > 0) {
            return redirect()->route('categories.index')
                             ->with('error', 'Impossible de supprimer : cette catégorie contient des œuvres d\'art');
        }

        $categorie->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Catégorie supprimée avec succès');
    }

}






