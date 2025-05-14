<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('title', 'Détails de la catégorie')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Détails de la catégorie</h2>
                    <div class="btn-group">
                        <a href="{{ route('categories.edit', $categorie) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('categories.destroy', $categorie) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">ID :</div>
                        <div class="col-md-8">{{ $categorie->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nom :</div>
                        <div class="col-md-8">{{ $categorie->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nombre d'œuvres :</div>
                        <div class="col-md-8">{{ $categorie->oeuvres_count }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Date de création :</div>
                        <div class="col-md-8">{{ $categorie->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fw-bold">Dernière modification :</div>
                        <div class="col-md-8">{{ $categorie->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
