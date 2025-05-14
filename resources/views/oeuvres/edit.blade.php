@extends('layouts.app')

@section('titre', 'Modifier une œuvre d\'art')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h2 class="mb-0">Modifier l'œuvre : {{ $oeuvre->titre }}</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('oeuvres.update', $oeuvre) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Colonne gauche -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="titre" class="form-label required">Titre de l'œuvre</label>
                                    <input type="text" class="form-control @error('titre') is-invalid @enderror"
                                           id="titre" name="titre" value="{{ old('titre', $oeuvre->titre) }}" required>
                                    @error('titre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="artiste" class="form-label required">Artiste</label>
                                    <input type="text" class="form-control @error('artiste') is-invalid @enderror"
                                           id="artiste" name="artiste" value="{{ old('artiste', $oeuvre->artiste) }}" required>
                                    @error('artiste')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="categorie_id" class="form-label required">Catégorie</label>
                                    <select class="form-select @error('categorie_id') is-invalid @enderror"
                                            id="categorie_id" name="categorie_id" required>
                                        @foreach($categories as $categorie)
                                            <option value="{{ $categorie->id }}"
                                                {{ (old('categorie_id', $oeuvre->categorie_id) == $categorie->id) ? 'selected' : '' }}>
                                                {{ $categorie->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('categorie_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="année" class="form-label required">Année de création</label>
                                    <input type="number" class="form-control @error('année') is-invalid @enderror"
                                           id="année" name="année" min="1000" max="{{ date('Y') }}"
                                           value="{{ old('année', $oeuvre->année) }}" required>
                                    @error('année')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Colonne droite -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="prix_estime" class="form-label required">Prix estimé (€)</label>
                                    <input type="number" step="0.01" class="form-control @error('prix_estime') is-invalid @enderror"
                                           id="prix_estime" name="prix_estime"
                                           value="{{ old('prix_estime', $oeuvre->prix_estime) }}" required>
                                    @error('prix_estime')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="acquisition_date" class="form-label required">Date d'acquisition</label>
                                    <input type="date" class="form-control @error('acquisition_date') is-invalid @enderror"
                                           id="acquisition_date" name="acquisition_date"
                                           value="{{ old('acquisition_date', isset($oeuvre->acquisition_date) ? date('Y-m-d', strtotime($oeuvre->acquisition_date)) : '') }}" required>
                                    @error('acquisition_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Nouvelle image (optionnel)</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                           id="image" name="image" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Laissez vide pour conserver l'image actuelle</div>
                                    @if($oeuvre->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $oeuvre->image) }}" alt="Image actuelle"
                                                 class="img-thumbnail" style="max-height: 150px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label required">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4" required>{{ old('description', $oeuvre->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="{{ route('oeuvres.show', $oeuvre) }}" class="btn btn-outline-secondary me-md-2">
                                <i class="bi bi-x-circle"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-warning text-dark">
                                <i class="bi bi-pencil-square"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
