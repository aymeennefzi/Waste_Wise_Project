@extends('layouts.adminLayout')
@section('content')

<div class="container my-5">
    <div class="d-flex mb-4">
        <h1 class="h3 mr-auto p-2">Posts Of Still Usable Items</h1>

        <!-- Search bar -->
        <form action="{{ route('admin.itemposts.index') }}" method="GET" class="form-inline ml-auto p-2">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search by name" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    @if($itemPosts->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No posts available at the moment.
        </div>
    @else
        <div class="row">
            @foreach ($itemPosts as $itemPost)
                <div class="col-md-6 mb-4">
                    <div class="card h-97 shadow-sm" style="height: 94%;">
                        <div class="row ">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $itemPost->image) }}" 
                                     class="card-img img-fluid" 
                                     alt="{{ $itemPost->name }}" 
                                     style="
                                         object-fit: cover;
                                         width: 100%;
                                         height: auto;
                                         margin-left: 6%;
                                         margin-top: 24%;
                                         max-height: 300px;
                                     ">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $itemPost->name }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($itemPost->description, 200) }}</p>
                                    <p class="card-text"><strong>Owner:</strong> {{ $itemPost->user ? $itemPost->user->name : 'Unknown' }}</p>
                                    <p class="card-text"><strong>Location:</strong> {{ $itemPost->address }}</p>
                                    <p class="card-text">
                                        <strong>Status:</strong> 
                                        @if($itemPost->status == 1)
                                            Available
                                        @elseif($itemPost->status == 2)
                                            Taken
                                        @elseif($itemPost->status == 3)
                                            Refused
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group position-absolute" style="top: 10px; right: 15px;">
                        @if($itemPost->user_id == Auth::id())
                            <a href="{{ route('admin.itemposts.edit', $itemPost->id) }}" class="btn btn-primary btn-sm" style="padding: 10px 9px; margin-right: 4px; margin-inline: 5px">Edit</a>
                            <form action="{{ route('admin.itemposts.destroy', $itemPost->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item post?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" style="background: #e94f4f; padding: 10px 9px; margin-right: 4px;">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
<!-- Custom Pagination -->
@if ($itemPosts->hasPages())
    <ul class="pagination justify-content-center mt-4">
        {{-- Previous Page Link --}}
        @if ($itemPosts->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true" style="color:#6B6F82">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $itemPosts->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true" style="color:#6B6F82">Previous</span>
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($itemPosts->getUrlRange(1, $itemPosts->lastPage()) as $page => $url)
            <li class="page-item {{ $page == $itemPosts->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}" style="color:#6B6F82">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        @if ($itemPosts->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $itemPosts->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true" style="color:#6B6F82">Next</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-hidden="true" style="color:#6B6F82">Next</span>
            </li>
        @endif
    </ul>
@endif

    @endif

    <!-- Chart Section -->
    <div class="card mt-5">
        <div class="card-body">
            <h4 class="card-title"> Stats of all Meetings</h4>
            <canvas id="statusChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Not Answred', 'Accepted', 'Refused'],
                datasets: [{
                    data: [{{ $statusCounts['available'] }}, {{ $statusCounts['taken'] }}, {{ $statusCounts['refused'] }}],
                    backgroundColor: ['#4caf50', '#ff9800', '#f44336'],
                    hoverBackgroundColor: ['#66bb6a', '#ffa726', '#e57373']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += context.raw;
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
