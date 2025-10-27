@extends('account.layout')

@section('title', 'Vehicles')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Vehicles</h1>
            <p class="text-muted mb-0">Add your 2024 vehicle data for your Internal Combustion Engine Vehicles (ICEVs). We'll ask you for information such as the vehicle type (e.g. passenger car), amount of fuel used (e.g. 740 liters), and distance driven (e.g. 982 kilometers). <a href="">Learn More</a>.</p>
        </div>
        <div>
            <a href="{{ route('account.vehicles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Vehicles +
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
        <div class="admin-header">Add Vehicle Data</div>
        <p>Add an Internal Combustion Engine Vehicle (ICEV) to your 2024 reporting year. This includes cars, trucks, or other motorized vehicles used by your organization which do not run on electricity. To add data for electric vehicles, add their primary charging station as a "Location" <a href="">here</a>.</p>
        <a href="{{ route('account.vehicles.create') }}" class="btn btn-primary mt-3">
            <i class="fas fa-plus"></i> Add Vehicle
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4">
        <input type="text" class="form-control" placeholder="Search added vehicles" id="vehicleSearch">
    </div>

    @if($vehicles->count() > 0)
        {{-- Vehicle Mini Cards --}}
        <div class="vehicle-mini-cards-container">
            <div class="row">
                @foreach($vehicles as $vehicle)
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="vehicle-mini-card" data-vehicle-name="{{ strtolower($vehicle->make . ' ' . $vehicle->model) }}">
                            <div class="vehicle-mini-card-content">
                                <div class="vehicle-mini-icon">
                                    @if($vehicle->vehicle_icon)
                                        <img src="/images/admin/vehicles/{{ $vehicle->vehicle_icon }}" alt="Vehicle" />
                                    @else
                                        <i class="fas fa-car"></i>
                                    @endif
                                </div>
                                <div class="vehicle-mini-info">
                                    <div class="vehicle-mini-name">
                                        {{ $vehicle->make }} →
                                    </div>
                                    <div class="vehicle-mini-type">
                                        {{ ucfirst($vehicle->vehicle_type ?? 'car') }}-{{ ucfirst($vehicle->usage_data_type ?? 'average') }}
                                    </div>
                                    @if($vehicle->model && $vehicle->year)
                                        <div class="vehicle-mini-details">
                                            {{ $vehicle->model }} ({{ $vehicle->year }})
                                        </div>
                                    @endif
                                </div>
                                <div class="vehicle-mini-actions">
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
            {{ $vehicles->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-car fa-4x text-muted mb-3"></i>
            <h4 class="text-muted">No vehicles found</h4>
            <p class="text-muted">Start by adding your first vehicle using the form above.</p>
            <a href="{{ route('account.vehicles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Vehicle
            </a>
        </div>
    @endif
</div>

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-end">
            <a href="{{ route('account.equipment.index') }}" class="btn btn-success btn-lg">
                Continue to Equipment <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
// Vehicle search functionality
document.addEventListener('DOMContentLoaded', function() {
    const vehicleSearch = document.getElementById('vehicleSearch');
    const vehicleCards = document.querySelectorAll('.vehicle-mini-card');

    if (vehicleSearch) {
        vehicleSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();

            vehicleCards.forEach(card => {
                const vehicleName = card.dataset.vehicleName || '';

                if (vehicleName.includes(searchTerm)) {
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
