@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-4">Add New Material</h2>
        <form action="{{ route('materials.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="material_name" class="form-label">Material Name</label>
                        <input type="text" class="form-control" id="material_name" name="material_name"
                               value="{{ old('material_name') }}" >
                        @error('material_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"
                                  rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="recycling_center_id" class="form-label">Recycling Center</label>
                        <select class="form-control" id="recycling_center_id" name="recycling_center_id" >
                            @foreach($recyclingCenters as $recyclingCenter)
                                <option value="{{ $recyclingCenter->id }}"
                                        {{ old('recycling_center_id') == $recyclingCenter->id ? 'selected' : '' }}>
                                    {{ $recyclingCenter->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('recycling_center_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Create Material</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection