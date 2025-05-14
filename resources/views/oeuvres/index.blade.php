@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Liste des œuvres d'art</h1>
        <a href="{{ route('oeuvres.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter une œuvre
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Artiste</th>
                    <th>Catégorie</th>
                    <th>Prix estimé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($oeuvres as $oeuvre)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $oeuvre->image_path) }}"
                             alt="{{ $oeuvre->titre }}"
                             class="img-thumbnail"
                             width="80">
                    </td>
                    <td>{{ $oeuvre->titre }}</td>
                    <td>{{ $oeuvre->artiste }}</td>
                    <td>{{ $oeuvre->categorie->name }}</td>
                    <td>{{ number_format($oeuvre->prix_estime, 2) }} €</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('oeuvres.show', $oeuvre) }}"
                               class="btn btn-sm btn-info"
                               titre="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('oeuvres.edit', $oeuvre) }}"
                               class="btn btn-sm btn-warning"
                               titre="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('oeuvres.destroy', $oeuvre) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        titre="Supprimer"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre ?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucune œuvre trouvée</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
