

@extends('layouts.user')

@section('content')
<div class="row mb-3">
    <h1 class="h3 mb-2 mb-sm-0">WasteTips</h1>
</div>
<div class="card bg-transparent border">
    <div class="card-header bg-light border-bottom">
        <div class="row g-3 align-items-center justify-content-between">
            <div class="col-md-12">
                <form class="rounded position-relative" method="GET" action="{{ route('WasteTips.index') }}">
                    <input type="text" name="query" class="form-control me-2" placeholder="Search wasteTips..." value="{{ request()->input('query') }}">
                    <button
                        class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                        type="submit"
                    >
                        <i class="fas fa-search fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
    @if($wasteTips->isEmpty())
        <div class="alert alert-secondary text-center" role="alert">
            Aucun Waste Tip disponible pour le moment...
        </div>
    @else
        @foreach($wasteTips as $wasteTip)
            <div class="row mb-3">
                <div class="col-md-2">
                    <img src="{{ asset('storage/' . $wasteTip->image) }}" alt="{{ $wasteTip->title }}" class="img-fluid fixed-size-img">
                </div>
                <div class="col-md-10">
                    <h5 class="card-title">{{ $wasteTip->title }}</h5>
                    <p class="card-text">{{ $wasteTip->content }}</p>
                    <p class="card-text"><small class="text-muted">Type de conseil: {{ $wasteTip->adviceType->name }}</small></p>
                </div>
            </div>
            <hr>
        @endforeach

       <!-- Pagination personnalisée -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $wasteTips->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link btn-sm" href="{{ $wasteTips->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @for ($i = 1; $i <= $wasteTips->lastPage(); $i++)
                    <li class="page-item {{ $i == $wasteTips->currentPage() ? 'active' : '' }}">
                        <a class="page-link btn-sm" href="{{ $wasteTips->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $wasteTips->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link btn-sm" href="{{ $wasteTips->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    @endif
</div>


@endsection
