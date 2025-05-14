@extends('layouts.app')

@section('title', $oeuvre->titre)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">{{ $oeuvre->titre }}</h2>
                    <div class="btn-group">
                        <a href="{{ route('oeuvres.edit', $oeuvre) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <form action="{{ route('oeuvres.destroy', $oeuvre) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre ?')">
                                <i class="bi bi-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Colonne image -->
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $oeuvre->image) }}"
                                     alt="{{ $oeuvre->titre }}"
                                     class="img-fluid rounded shadow oeuvre-detail-img">
                                <div class="mt-3">
                                    <span class="badge bg-primary fs-6">
                                        {{ $oeuvre->categorie->name }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne détails -->
                        <div class="col-md-7">
                            <div class="oeuvre-details">
                                <h3 class="text-primary">{{ $oeuvre->titre }}</h3>
                                <p class="lead">Par {{ $oeuvre->artiste }}</p>
                                <hr>

                                <div class="mb-3">
                                    <h5>Description</h5>
                                    <p class="text-muted">{{ $oeuvre->description }}</p>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Année de création</h6>
                                                <p class="card-text fs-5">{{ $oeuvre->année }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Prix estimé</h6>
                                                <p class="card-text fs-5">{{ number_format($oeuvre->prix_estime, 2) }} €</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Date d'acquisition</h6>
                                                <p class="card-text fs-5">
                                                    {{ isset($oeuvre->date_acquisition) ? date('d/m/Y', strtotime($oeuvre->date_acquisition)) : 'Non renseignée' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <h6 class="card-title">Ajoutée le</h6>
                                                <p class="card-text fs-5">
                                                    {{ isset($oeuvre->created_at) ? date('d/m/Y H:i', strtotime($oeuvre->created_at)) : 'Non renseignée' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('oeuvres.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Retour à la galerie
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .oeuvre-detail-img {
        max-height: 400px;
        object-fit: contain;
    }
    .oeuvre-details {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
</style>
@endsection
