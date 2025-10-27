@extends('account.layout')

@section('title', 'Equipment')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Equipment</h1>
            <p class="text-muted mb-0">Add your 2024 equipment data. We'll ask you for information such as the equipment type (e.g. generator) and usage data (e.g. amount of fuel consumed). <a href="">Learn More</a></p>
        </div>
        <div>
            <a href="{{ route('account.equipment.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Equipment +
            </a>
            <button class="btn btn-outline-secondary ms-2">
                <i class="fas fa-cog"></i>
            </button>
        </div>
    </div>
</div>

<div class="content-body">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Description Text --}}
    <div class="text-center mb-4">
        <div class="admin-header">Add Equipment</div>
        <p>Add equipment to your 2024 reporting year. This includes backup generators, chillers, and other machinery used by your organization. <a href="">Learn more</a></p>
        <a href="{{ route('account.equipment.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus"></i> Add Equipment
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Search added equipment" id="equipmentSearch">
    </div>

    @if($equipment->count() > 0)
        {{-- Equipment Mini Cards --}}
        <div class="equipment-mini-cards-container">
            <div class="row">
                @foreach($equipment as $item)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="equipment-mini-card" data-equipment-name="{{ strtolower($item->name . ' ' . $item->type) }}">
                            <div class="equipment-mini-card-content">
                                <div class="equipment-mini-icon">
                                    @if($item->equipment_icon)
                                        <img src="/images/admin/equipment/{{ $item->equipment_icon }}" alt="Equipment" />
                                    @else
                                        <i class="fas fa-cogs"></i>
                                    @endif
                                </div>
                                <div class="equipment-mini-info">
                                    <div class="equipment-mini-name">
                                        {{ $item->name }} →
                                    </div>
                                    <div class="equipment-mini-type">
                                        {{ ucfirst($item->type) }}
                                    </div>
                                </div>
                                <div class="equipment-mini-actions">
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-flex justify-content-center">
            {{ $equipment->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-cogs fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No equipment found</h4>
            <p class="text-muted">Get started by adding your first piece of equipment.</p>
            <a href="{{ route('account.equipment.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Equipment
            </a>
        </div>
    @endif
</div>

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <a href="{{ route('account.scope1.natural-gas') }}" class="btn btn-success btn-lg">
                Continue to Natural Gas Consumption (Location) <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
// Equipment search functionality
document.addEventListener('DOMContentLoaded', function() {
    const equipmentSearch = document.getElementById('equipmentSearch');
    const equipmentCards = document.querySelectorAll('.equipment-mini-card');

    if (equipmentSearch) {
        equipmentSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            equipmentCards.forEach(card => {
                const equipmentName = card.dataset.equipmentName || '';

                if (equipmentName.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
});
</script>
@endsection
