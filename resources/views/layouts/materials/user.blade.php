@extends('layouts.user')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Liste des Matériaux</h1>
    </div>

    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-hover text-center" style="border-radius: 10px; overflow: hidden;">
            <thead style="background-color: #4A4A4A; color: white;"> {{-- Custom dark header --}}
                <tr>
                    <th class="py-3 text-uppercase">Nom du Matériau</th>
                    <th class="py-3 text-uppercase">Description</th>
                    <th class="py-3 text-uppercase">Centre de Recyclage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $material)
                    <tr class="align-middle" style="transition: background-color 0.2s;">
                        <td class="py-3">{{ $material->material_name }}</td>
                        <td class="py-3">{{ Str::limit($material->description, 50) }}</td>
                        <td class="py-3">{{ $material->recyclingCenter->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4">
        {{ $materials->links('pagination::bootstrap-4') }} {{-- Styled pagination links --}}
    </div>
</div>
@endsection

<style>
    /* Add custom styles for a modern table look */
    .table th, .table td {
        vertical-align: middle;
        border-color: #e0e0e0 !important; /* Light border color */
    }

    .table-hover tbody tr:hover {
        background-color: #f5f5f5 !important; /* Light grey on hover */
    }

    .table thead th {
        letter-spacing: 0.05em;
        font-size: 0.875rem; /* Slightly smaller text for table headers */
    }

    .table {
        border-collapse: separate;
        border-spacing: 0;
    }

    .table-bordered {
        border: 1px solid #ddd; /* Lighter border for the table */
    }

    .table-responsive {
        border-radius: 10px;
        overflow: hidden; /* To apply border-radius to the table container */
    }

    .pagination {
        margin-bottom: 0; /* Remove extra margin on pagination */
    }

    .pagination .page-link {
        color: #007bff; /* Link color */
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination .page-link:hover {
        background-color: #f5f5f5;
    }
</style>
