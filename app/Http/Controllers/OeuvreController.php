<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class OeuvreController extends Controller
{
    public function index()
    {
        $oeuvres = Oeuvre::with('categorie')->get();
        return view('oeuvres.index', compact('oeuvres'));
    }

    public function create()
    {
        $categories = Categorie::all();
        return view('oeuvres.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'artiste' => 'required|string|max:255',
            'année' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'prix_estime' => 'required|numeric',
            'date_acquisition' => 'required|date',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image')->store('oeuvres_images', 'public');

        Oeuvre::create([
            'titre' => $validated['titre'],
            'artiste' => $validated['artiste'],
            'année' => $validated['année'],
            'prix_estime' => $validated['prix_estime'],
            'date_acquisition' => $validated['date_acquisition'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'categorie_id' => $validated['categorie_id'],
        ]);

        return redirect()->route('oeuvres.index')->with('success', 'Œuvre d\'art ajoutée avec succès');
    }

    public function show(Oeuvre $oeuvre)
    {
        return view('oeuvres.show', compact('oeuvre'));
    }


    public function edit(Oeuvre $oeuvre)
    {
        $categories = Categorie::all();
        return view('oeuvres.edit', compact('oeuvre', 'categories'));
    }


    public function update(Request $request, Oeuvre $oeuvre)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'artiste' => 'required|string|max:255',
            'année' => 'required|integer|min:1000|max:' . (date('Y') + 1),
            'prix_estime' => 'required|numeric|min:0',
            'date_acquisition' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $data = [
            'titre' => $validated['titre'],
            'artiste' => $validated['artiste'],
            'année' => $validated['année'],
            'prix_estime' => $validated['prix_estime'],
            'date_acquisition' => $validated['date_acquisition'],
            'description' => $validated['description'],
            'categorie_id' => $validated['categorie_id'],
        ];

        // Gestion de l'image si une nouvelle est fournie
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            Storage::disk('public')->delete($oeuvre->image_path);

            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('oeuvre_images', 'public');
            $data['image_path'] = $imagePath;
        }

        $oeuvre->update($data);

        return redirect()->route('oeuvres.show', $oeuvre)
                         ->with('success', 'Œuvre d\'art mise à jour avec succès');
    }


    public function destroy(Oeuvre $oeuvre)
    {
        // Supprimer l'image associée
        Storage::disk('public')->delete($oeuvre->image_path);

        $oeuvre->delete();

        return redirect()->route('oeuvres.index')
                         ->with('success', 'Œuvre d\'art supprimée avec succès');
    }

}





