@extends('account.layout')

@section('title', 'Add Vehicle')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Add New Vehicle</h1>
            <p class="text-muted mb-0">Add a new vehicle to your fleet</p>
        </div>
        <div>
            <a href="{{ route('account.vehicles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Vehicles
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Errors:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('account.vehicles.store') }}" method="POST">
        @csrf

        <div class="text-center">
            <div class="admin-header">Add Vehicle Data</div>
            <p>Add an Internal Combustion Engine Vehicle (ICEV) to your 2024 reporting year. This includes cars, trucks, or other motorized vehicles used by your organization which do not run on electricity. To add data for electric vehicles, add their primary charging station as a "Location" <a href="">here</a>.</p>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="make" class="form-label">What is the name or ID of this vehicle?</label>
                <input type="text" class="form-control @error('make') is-invalid @enderror"
                        id="make" name="make" value="{{ old('make') }}" required>
                @error('make')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem">Give this vehicle a name or ID number to make it easier to identify it later.</h6>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Auto-complete this form with VIN(Optional)</label>
                <input type="text" class="form-control @error('model') is-invalid @enderror"
                        id="model" name="model" value="{{ old('model') }}">
                @error('model')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem">We will be able to complete information like Make, Model, Year, and Vehicle Type automatically using the VIN number.</h6>
            </div>

            <div class="" style="background: #dee2e6; padding: 1rem; border-radius: 15px;">
                <div class="" style="border-bottom: 1px solid gray; font-weight: 700; cursor: pointer; display: flex; justify-content: space-between; align-items: center;" onclick="toggleMakeModel()">
                    <span>Make / Model (Optional)</span>
                    <i id="makeModelIcon" class="fas fa-chevron-up" style="transition: transform 0.3s ease;"></i>
                </div>
                <div id="makeModelContent" style="display: block; margin-top: 1rem;">
                <div class="mb-3">
                    <label for="year" class="form-label">Year (Optional)</label>
                    <div class="custom-dropdown @error('year') is-invalid @enderror">
                        <button type="button" class="custom-dropdown-toggle" id="yearDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @if(old('year'))
                                    {{ old('year') }}
                                @else
                                    Select Year
                                @endif
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="year" name="year" value="{{ old('year') ?: '' }}">
                        <ul class="dropdown-menu" id="yearDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="">Select Year</a></li>
                            @for($year = date('Y') + 1; $year >= 1990; $year--)
                                <li><a class="dropdown-item" href="#" data-value="{{ $year }}">{{ $year }}</a></li>
                            @endfor
                        </ul>
                    </div>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="make_optional" class="form-label">Make (Optional)</label>
                    <div class="custom-dropdown">
                        <button type="button" class="custom-dropdown-toggle" id="makeDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @if(old('make_optional'))
                                    {{ old('make_optional') }}
                                @else
                                    Select Make
                                @endif
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="make_optional" name="make_optional" value="{{ old('make_optional') ?: '' }}">
                        <ul class="dropdown-menu" id="makeDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="">Select Make</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Toyota">Toyota</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Honda">Honda</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Ford">Ford</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Chevrolet">Chevrolet</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Nissan">Nissan</a></li>
                            <li><a class="dropdown-item" href="#" data-value="BMW">BMW</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Mercedes-Benz">Mercedes-Benz</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Audi">Audi</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Volkswagen">Volkswagen</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Hyundai">Hyundai</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Kia">Kia</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Mazda">Mazda</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Subaru">Subaru</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Lexus">Lexus</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Acura">Acura</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Infiniti">Infiniti</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Volvo">Volvo</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Jaguar">Jaguar</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Land Rover">Land Rover</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Porsche">Porsche</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Tesla">Tesla</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Other">Other</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="model_optional" class="form-label">Model (Optional)</label>
                    <div class="custom-dropdown">
                        <button type="button" class="custom-dropdown-toggle" id="modelDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @if(old('model_optional'))
                                    {{ old('model_optional') }}
                                @else
                                    Select Model
                                @endif
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="model_optional" name="model_optional" value="{{ old('model_optional') ?: '' }}">
                        <ul class="dropdown-menu" id="modelDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="">Select Model</a></li>
                            <!-- Toyota Models -->
                            <li class="dropdown-header">Toyota</li>
                            <li><a class="dropdown-item" href="#" data-value="Camry">Camry</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Corolla">Corolla</a></li>
                            <li><a class="dropdown-item" href="#" data-value="RAV4">RAV4</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Highlander">Highlander</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Prius">Prius</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Tacoma">Tacoma</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Tundra">Tundra</a></li>
                            <!-- Honda Models -->
                            <li class="dropdown-header">Honda</li>
                            <li><a class="dropdown-item" href="#" data-value="Civic">Civic</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Accord">Accord</a></li>
                            <li><a class="dropdown-item" href="#" data-value="CR-V">CR-V</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Pilot">Pilot</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Odyssey">Odyssey</a></li>
                            <li><a class="dropdown-item" href="#" data-value="HR-V">HR-V</a></li>
                            <!-- Ford Models -->
                            <li class="dropdown-header">Ford</li>
                            <li><a class="dropdown-item" href="#" data-value="F-150">F-150</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Escape">Escape</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Explorer">Explorer</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Focus">Focus</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Fusion">Fusion</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Mustang">Mustang</a></li>
                            <!-- BMW Models -->
                            <li class="dropdown-header">BMW</li>
                            <li><a class="dropdown-item" href="#" data-value="3 Series">3 Series</a></li>
                            <li><a class="dropdown-item" href="#" data-value="5 Series">5 Series</a></li>
                            <li><a class="dropdown-item" href="#" data-value="X3">X3</a></li>
                            <li><a class="dropdown-item" href="#" data-value="X5">X5</a></li>
                            <li><a class="dropdown-item" href="#" data-value="X1">X1</a></li>
                            <!-- Tesla Models -->
                            <li class="dropdown-header">Tesla</li>
                            <li><a class="dropdown-item" href="#" data-value="Model S">Model S</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Model 3">Model 3</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Model X">Model X</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Model Y">Model Y</a></li>
                            <li><a class="dropdown-item" href="#" data-value="Other">Other</a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">What usage data do you have for this vehicle?</label>
            <div class="mt-2">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="usage_data_type" id="usage_distance" value="distance" {{ old('usage_data_type') == 'distance' ? 'checked' : '' }} onchange="showVehicleType()">
                    <label class="form-check-label" for="usage_distance">
                        Vehicle Usage (Distance)
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="usage_data_type" id="usage_fuel" value="fuel" {{ old('usage_data_type') == 'fuel' ? 'checked' : '' }} onchange="showVehicleType()">
                    <label class="form-check-label" for="usage_fuel">
                        Vehicle Usage (Fuel)
                    </label>
                </div>
            </div>
            @error('usage_data_type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div id="vehicle-type-section" class="mb-3" style="display: none;">
            <label class="form-label">What kind of vehicle is this?</label>
            <div class="mt-2">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="car" value="car" {{ old('vehicle_type') == 'car' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="car">
                        Car - Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="truck" value="truck" {{ old('vehicle_type') == 'truck' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="truck">
                        Heavy Goods Vehicle (Truck)-Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="motorbike" value="motorbike" {{ old('vehicle_type') == 'motorbike' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="motorbike">
                        Motorbike - Average
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle_type" id="van" value="van" {{ old('vehicle_type') == 'van' ? 'checked' : '' }} onchange="showVehicleIcon()">
                    <label class="form-check-label" for="van">
                        Van- Average
                    </label>
                </div>
            </div>
            @error('vehicle_type')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div id="vehicle-icon-section" class="mb-3" style="display: none;">
            <label class="form-label">Vehicle Icon *</label>
            <div class="vehicle-icon-container">
                <div class="vehicle-icon-selected">
                    <div class="selected-icon" id="selectedIcon">
                        <img src="/images/admin/vehicles/sedan.svg" alt="Selected Vehicle" />
                    </div>
                </div>
                <div class="vehicle-icon-choices">
                    <div class="icon-grid">
                        <!-- Icons will be dynamically loaded based on vehicle type -->
                    </div>
                </div>
            </div>
            <input type="hidden" name="vehicle_icon" id="vehicleIconInput" value="sedan.svg">
        </div>

        <div class="mb-3">
            <label for="location_id" class="form-label">Where is this vehicle located?(Optional)</label>
            <div class="custom-dropdown @error('location_id') is-invalid @enderror">
                <button type="button" class="custom-dropdown-toggle" id="locationDropdownToggle" aria-expanded="false">
                    <span class="dropdown-text">
                        @if(old('location_id'))
                            @foreach($locations as $location)
                                @if(old('location_id') == $location->id)
                                    {{ $location->name }}
                                @endif
                            @endforeach
                        @else
                            Select a location
                        @endif
                    </span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <input type="hidden" id="location_id" name="location_id" value="{{ old('location_id') ?: '' }}">
                <ul class="dropdown-menu" id="locationDropdownMenu">
                    <li><a class="dropdown-item" href="#" data-value="">Select a location</a></li>
                    @if(isset($locations))
                        @foreach($locations as $location)
                            <li><a class="dropdown-item" href="#" data-value="{{ $location->id }}">
                                <div class="location-option">
                                    <div class="location-name">{{ $location->name }}</div>
                                    @if($location->address || $location->city || $location->state || $location->postal_code || $location->country)
                                        <div class="location-address text-muted small">
                                            @if($location->address){{ $location->address }}, @endif
                                            @if($location->city){{ $location->city }}, @endif
                                            @if($location->state){{ $location->state }} @endif
                                            @if($location->postal_code){{ $location->postal_code }} @endif
                                            @if($location->country){{ $location->country }}@endif
                                        </div>
                                    @endif
                                </div>
                            </a></li>
                        @endforeach
                    @else
                        <li><a class="dropdown-item" href="#" data-value="" style="color: #6c757d; font-style: italic;">No locations available</a></li>
                    @endif
                </ul>
            </div>
            @error('location_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('account.vehicles.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Vehicle
            </button>
        </div>
    </form>
</div>

<script>
function toggleMakeModel() {
    const content = document.getElementById('makeModelContent');
    const icon = document.getElementById('makeModelIcon');

    if (content.style.display === 'none') {
        // Show content
        content.style.display = 'block';
        icon.className = 'fas fa-chevron-up';
        icon.style.transform = 'rotate(0deg)';
    } else {
        // Hide content
        content.style.display = 'none';
        icon.className = 'fas fa-chevron-down';
        icon.style.transform = 'rotate(0deg)';
    }
}

function showVehicleType() {
    const vehicleTypeSection = document.getElementById('vehicle-type-section');
    const usageDistance = document.getElementById('usage_distance');
    const usageFuel = document.getElementById('usage_fuel');

    if (usageDistance.checked || usageFuel.checked) {
        vehicleTypeSection.style.display = 'block';
    } else {
        vehicleTypeSection.style.display = 'none';
    }
}

function showVehicleIcon() {
    const vehicleIconSection = document.getElementById('vehicle-icon-section');
    const carRadio = document.getElementById('car');
    const truckRadio = document.getElementById('truck');
    const motorbikeRadio = document.getElementById('motorbike');
    const vanRadio = document.getElementById('van');

    if (carRadio.checked || truckRadio.checked || motorbikeRadio.checked || vanRadio.checked) {
        vehicleIconSection.style.display = 'block';

        // Update icon grid based on vehicle type
        updateIconGrid();
    } else {
        vehicleIconSection.style.display = 'none';
    }
}

function updateIconGrid() {
    const carRadio = document.getElementById('car');
    const truckRadio = document.getElementById('truck');
    const motorbikeRadio = document.getElementById('motorbike');
    const vanRadio = document.getElementById('van');
    const iconGrid = document.querySelector('.icon-grid');

    if (carRadio.checked) {
        // Show car icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="sedan.svg" data-label="Sedan">
                <img src="/images/admin/vehicles/sedan.svg"/>
            </div>
            <div class="icon-choice" data-icon="hatchback.svg" data-label="Hatchback">
                <img src="/images/admin/vehicles/hatchback.svg"/>
            </div>
            <div class="icon-choice" data-icon="suv.svg" data-label="SUV">
                <img src="/images/admin/vehicles/suv.svg"/>
            </div>
            <div class="icon-choice" data-icon="convertible.svg" data-label="Convertible">
                <img src="/images/admin/vehicles/convertible.svg"/>
            </div>
            <div class="icon-choice" data-icon="truck.svg" data-label="Truck">
                <img src="/images/admin/vehicles/truck.svg"/>
            </div>
        `;

        // Update selected icon to first car icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/sedan.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'sedan.svg';

    } else if (truckRadio.checked) {
        // Show truck icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="heavy-duty-truck.svg" data-label="Heavy Duty Truck">
                <img src="/images/admin/vehicles/heavy-duty-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="lorry.svg" data-label="Lorry">
                <img src="/images/admin/vehicles/lorry.svg" />
            </div>
            <div class="icon-choice" data-icon="semi-lorry.svg" data-label="Semi Lorry">
                <img src="/images/admin/vehicles/semi-lorry.svg" />
            </div>
            <div class="icon-choice" data-icon="lift-truck.svg" data-label="Lift Truck">
                <img src="/images/admin/vehicles/lift-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="fork-lift.svg" data-label="Fork Lift">
                <img src="/images/admin/vehicles/fork-lift.svg" />
            </div>
            <div class="icon-choice" data-icon="van.svg" data-label="Van">
                <img src="/images/admin/vehicles/van.svg" />
            </div>
            <div class="icon-choice" data-icon="metro-bus.svg" data-label="Metro Bus">
                <img src="/images/admin/vehicles/metro-bus.svg" />
            </div>
        `;

        // Update selected icon to first truck icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/heavy-duty-truck.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'heavy-duty-truck.svg';

    } else if (motorbikeRadio.checked) {
        // Show motorbike icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="motorbike.svg" data-label="Motorbike">
                <img src="/images/admin/vehicles/motorbike.svg" />
            </div>
            <div class="icon-choice" data-icon="bike.svg" data-label="Bike">
                <img src="/images/admin/vehicles/bike.svg" />
            </div>
        `;

        // Update selected icon to first motorbike icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/motorbike.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'motorbike.svg';

    } else if (vanRadio.checked) {
        // Show van icons
        iconGrid.innerHTML = `
            <div class="icon-choice active" data-icon="van.svg" data-label="Van">
                <img src="/images/admin/vehicles/van.svg" />
            </div>
            <div class="icon-choice" data-icon="passenger-car-truck.svg" data-label="Passenger Car Truck">
                <img src="/images/admin/vehicles/passenger-car-truck.svg" />
            </div>
            <div class="icon-choice" data-icon="car-van.svg" data-label="Car Van">
                <img src="/images/admin/vehicles/car-van.svg" />
            </div>
        `;

        // Update selected icon to first van icon
        document.getElementById('selectedIcon').innerHTML = '<img src="/images/admin/vehicles/van.svg" alt="Selected Vehicle" />';
        document.getElementById('vehicleIconInput').value = 'van.svg';
    }

    // Reattach event listeners to new icons
    attachIconListeners();
}

function attachIconListeners() {
    const iconChoices = document.querySelectorAll('.icon-choice');
    const selectedIcon = document.getElementById('selectedIcon');
    const vehicleIconInput = document.getElementById('vehicleIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            // Remove active class from all choices
            iconChoices.forEach(c => c.classList.remove('active'));

            // Add active class to clicked choice
            this.classList.add('active');

            // Update selected icon display
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/vehicles/${iconFilename}" alt="Selected Vehicle" />`;

            // Update hidden input
            vehicleIconInput.value = iconFilename;
        });
    });
}

// Initialize sections on page load
document.addEventListener('DOMContentLoaded', function() {
    showVehicleType();
    showVehicleIcon();

    // Custom dropdown functionality
    setupCustomDropdowns();

    // If optional Make/Model are selected and primary fields are empty, copy over on submit
    const form = document.querySelector('form[action*="vehicles"]');
    form.addEventListener('submit', function() {
        const makePrimary = document.getElementById('make');
        const makeOptional = document.getElementById('make_optional');
        if (makePrimary && makeOptional && !makePrimary.value && makeOptional.value) {
            makePrimary.value = makeOptional.value;
        }

        const modelPrimary = document.getElementById('model');
        const modelOptional = document.getElementById('model_optional');
        if (modelPrimary && modelOptional && !modelPrimary.value && modelOptional.value) {
            modelPrimary.value = modelOptional.value;
        }
    });

    // Handle icon selection
    const iconChoices = document.querySelectorAll('.icon-choice');
    const selectedIcon = document.getElementById('selectedIcon');
    const vehicleIconInput = document.getElementById('vehicleIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            // Remove active class from all choices
            iconChoices.forEach(c => c.classList.remove('active'));

            // Add active class to clicked choice
            this.classList.add('active');

            // Update selected icon display
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/vehicles/${iconFilename}" alt="Selected Vehicle" />`;

            // Update hidden input
            vehicleIconInput.value = iconFilename;
        });
    });
});

function setupCustomDropdowns() {
    // Handle all custom dropdown toggles
    document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdown = this.closest('.custom-dropdown');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            const isOpen = dropdownMenu.classList.contains('show');

            // Close all other dropdowns
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });

            // Toggle current dropdown
            if (!isOpen) {
                dropdownMenu.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Handle dropdown item clicks
    document.querySelectorAll('.custom-dropdown .dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.custom-dropdown');
            const toggle = dropdown.querySelector('.custom-dropdown-toggle');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const dropdownText = toggle.querySelector('.dropdown-text');

            // Get display text (handle location-option structure)
            const locationName = this.querySelector('.location-name');
            const displayText = locationName ? locationName.textContent : this.textContent;

            // Update the button text
            dropdownText.textContent = displayText;

            // Update the hidden input value
            hiddenInput.value = this.dataset.value;

            // Close the dropdown
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });
        }
    });
}
</script>

@endsection
