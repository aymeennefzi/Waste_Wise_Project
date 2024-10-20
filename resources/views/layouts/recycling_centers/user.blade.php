@extends('layouts.user') 

@section('title', 'Liste des centres de recyclage')

@section('content')
    <style>
        .card-container {
            display: flex;
            flex-wrap: wrap;
            margin: -16px; /* Pour compenser les marges des cartes */
        }

        .card {
            width: calc(25% - 32px); /* Quatre cartes par ligne avec espace */
            margin: 16px;
            background-color: white;
            border-radius: 12px; /* Coins arrondis */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s, transform 0.3s; /* Ajout d'une transition pour la transformation */
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            transform: translateY(-4px); /* Légère élévation au survol */
        }

        .card img {
            width: 100%;
            height: 180px; /* Hauteur fixe pour l'image */
            object-fit: cover; /* Ajuste l'image pour qu'elle remplisse le conteneur */
        }

        .card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333; /* Couleur du titre */
            margin: 0;
            padding: 16px;
        }

        .card p {
            color: #555; /* Couleur de texte pour les paragraphes */
            padding: 0 16px 8px;
            margin: 0; /* Réinitialisation des marges pour éviter les décalages */
            line-height: 1.5; /* Amélioration de l'interlignage */
        }

        .card a {
            color: #3B82F6; /* Couleur du lien */
            text-decoration: underline;
            display: block;
            padding: 8px 16px;
            margin: 16px; /* Ajout d'une marge pour espacer les liens */
            transition: color 0.3s; /* Transition pour le changement de couleur */
        }

        .card a:hover {
            color: #2563EB; /* Couleur du lien au survol */
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 32px); /* Deux cartes par ligne sur les petits écrans */
            }
        }

        @media (max-width: 480px) {
            .card {
                width: 100%; /* Une carte par ligne sur les très petits écrans */
            }
        }
    </style>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($centers->isEmpty())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Aucun centre trouvé !</strong>
                <span class="block sm:inline">Veuillez réessayer plus tard.</span>
            </div>
        @else
            <!-- Liste des cartes avec Flexbox -->
            <div class="card-container">
                @foreach ($centers as $center)
                    <div class="card">
                        <img src="{{ asset('storage/' . $center->image) }}" alt="{{ $center->name }}">
                        <div class="p-4">
                            <h3>{{ $center->name }}</h3>
                            <p>
                                <i class="fas fa-map-marker-alt text-red-500"></i> {{ $center->address }}
                            </p>
                            <p>
                                <i class="fas fa-clock text-yellow-500"></i> {{ $center->opening_hours }}
                            </p>
                            <p class="text-gray-600">
                                <i class="fas fa-compass text-blue-500"></i> Latitude : <span class="font-medium">{{ $center->latitude }}</span>
                            </p>
                            <p class="text-gray-600">
                                <i class="fas fa-compass text-blue-500"></i> Longitude : <span class="font-medium">{{ $center->longitude }}</span>
                            </p>
                            @if($center->location)
                                <p class="mt-4">
                                    <a href="{{ $center->location }}" target="_blank" class="text-blue-500 hover:underline flex items-center">
                                        <i class="fas fa-map-marked-alt text-green-500 mr-2"></i> Voir sur Google Maps
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
