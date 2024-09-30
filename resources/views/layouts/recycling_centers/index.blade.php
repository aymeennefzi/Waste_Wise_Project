<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des centres de recyclage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .card-container:hover .card-image {
            transform: scale(1.1);
            transition: transform 0.5s;
        }

        /* Afficher les icônes d'administration au hover */
        .card-container:hover .admin-icons {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s, transform 0.3s;
        }

        .admin-icons {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transform: translateY(-10px);
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto p-4 flex justify-between items-center">
            <a href="/" class="text-lg font-semibold text-gray-800 hover:text-green-500 transition">
                <i class="fas fa-home"></i> Accueil
            </a>
            <a href="/recycling-center" class="ml-4 text-lg text-gray-600 hover:text-green-500 transition">
                <i class="fas fa-recycle"></i> Centres de recyclage
            </a>
        </div>
    </nav>

    <!-- Page Heading -->
    <header class="bg-white shadow mt-6">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight flex items-center">
                <i class="fas fa-map-marker-alt text-green-500 mr-3"></i> Liste des centres de recyclage
            </h2>

            <!-- Bouton Créer un Nouveau Centre (visible uniquement pour l'admin) -->
            @if(auth()->check() && auth()->user()->utype == 'ADMIN')
                <a href="{{ route('recycling_centers.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                    <i class="fas fa-plus-circle"></i> Créer un nouveau centre de recyclage
                </a>
            @endif
        </div>
    </header>

    <!-- Page Content -->
    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($centers->isEmpty())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Aucun centre de recyclage trouvé !</strong>
                    <span class="block sm:inline">Veuillez vérifier plus tard.</span>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($centers as $center)
                        <div class="relative bg-white overflow-hidden shadow-lg rounded-lg card-container transition duration-300 transform hover:scale-105">
                            <div class="relative h-48 overflow-hidden rounded-t-lg">
                                <!-- Utilisation du chemin dynamique pour afficher l'image -->
                                <img src="{{ asset('storage/' . $center->image) }}" alt="{{ $center->name }}" class="w-full h-full object-cover card-image">
                                
                                <!-- Icônes d'administration (affichées uniquement si l'utilisateur est un admin) -->
                                @if(auth()->check() && auth()->user()->utype == 'ADMIN')
                                    <div class="admin-icons">
                                        <a href="{{ route('recycling_centers.edit', $center->id) }}" class="text-blue-500 hover:text-blue-600 mx-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('recycling_centers.destroy', $center->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce centre de recyclage ?')" class="text-red-500 hover:text-red-600">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 hover:text-green-600 transition">
                                    <i class="fas fa-building text-green-500 mr-2"></i>{{ $center->name }}
                                </h3>
                                <p class="text-gray-600 mt-1">
                                    <i class="fas fa-map-marker-alt text-red-500"></i> Adresse : <span class="font-medium">{{ $center->address }}</span>
                                </p>
                                <p class="text-gray-600">
                                    <i class="fas fa-compass text-blue-500"></i> Latitude : <span class="font-medium">{{ $center->latitude }}</span>
                                </p>
                                <p class="text-gray-600">
                                    <i class="fas fa-compass text-blue-500"></i> Longitude : <span class="font-medium">{{ $center->longitude }}</span>
                                </p>
                                <p class="text-gray-600">
                                    <i class="far fa-clock text-yellow-500"></i> Heures d'ouverture : <span class="font-medium">{{ $center->opening_hours }}</span>
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
    </main>

    <!-- Footer -->
    <footer class="bg-white mt-12 shadow-lg py-4">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-600">
            &copy; 2024 Waste Wise - Tous droits réservés.
        </div>
    </footer>
</body>
</html>
