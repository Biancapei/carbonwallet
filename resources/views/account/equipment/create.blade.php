@extends('account.layout')

@section('title', 'Add Equipment')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Add New Equipment</h1>
            <p class="text-muted mb-0">Add new equipment to your monitoring system</p>
        </div>
        <div>
            <a href="{{ route('account.equipment.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Equipment
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <form action="{{ route('account.equipment.store') }}" method="POST">
        @csrf

        <div class="text-center">
            <div class="admin-header">Add Equipment</div>
            <p>Add equipment to your 2024 reporting year. This includes backup generators, chillers, and other machinery used by your organization. <a href="">Learn more</a></p>
        </div>

        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">What is the name or ID of this equipment?</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 style="font-size: .75rem;">Give this equipment a name or ID number to make it easier to identify it later. Field required.</h6>
            </div>
        </div>

        <div class="row">
            <div class="mb-3">
                <label class="form-label">Please select the following that apply. You can always update these later.</label>
                <div class="checkbox">
                    <div class="">
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_a" id="equipment_a" {{ in_array('equipment_a', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment consumes fuel</span>
                                <h6>Select this if your equipment runs on fuel (gasoline, diesel, etc). To avoid double counting, if you’ve already accounted for natural gas usage at the facility level, there’s no need to add natural gas boilers as equipment here.</h6>
                            </div>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_b" id="equipment_b" {{ in_array('equipment_b', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment uses refrigerants</span>
                                <h6>Select this if your company purchases refrigerants used by equipment owned by your organization including mobile air conditioning, chillers, retail food refrigeration, refrigerated transport, etc.</h6>
                            </div>
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="equipment[]" value="equipment_c" id="equipment_c" {{ in_array('equipment_c', old('equipment', [])) ? 'checked' : '' }}>
                            <div class="text-content">
                                <span>This equipment uses industrial gases</span>
                                <h6>Select this if your company purchases industrial gases, such as carbon dioxide, methane, nitrous oxide, sulfur hexafluoride, and nitrogen trifluoride, used in manufacturing, testing, or laboratory applications.</h6>
                            </div>
                        </label>
                    </div>
                </div>
                @error('equipment')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row justify-content-center">
            <p style="margin-bottom: 0; text-align: center; border: 1px solid #ccc; border-radius: 6px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); padding: 1rem 1rem; width: 80%;">Looking for the option to track electricity by equipment? You’ll track your electricity usage in the utilities section when you add a location.</p>
        </div>

        <div class="row" id="equipmentTypeSection" style="display: none;">
            <div class="my-3">
                <label for="type" class="form-label">What kind of equipment is this?</label>
                <div class="custom-dropdown @error('type') is-invalid @enderror">
                    <button type="button" class="custom-dropdown-toggle" aria-expanded="false">
                        <span class="dropdown-text">Select equipment type</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <input type="hidden" id="type" name="type" value="" required>
                    <ul class="dropdown-menu" id="equipmentTypeDropdown">
                        <!-- Options will be populated dynamically based on checkbox selection -->
                    </ul>
                </div>
                @error('type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Equipment Icon Selection -->
        <div id="equipment-icon-section" class="mb-3" style="display: none;">
            <label class="form-label">Equipment Icon</label>
            <div class="equipment-icon-container">
                <div class="equipment-icon-selected">
                    <div class="selected-icon" id="selectedEquipmentIcon">
                        <img src="/images/admin/equipment/portable.svg" />
                    </div>
                </div>
                <div class="equipment-icon-choices">
                    <div class="icon-grid" id="equipmentIconGrid">
                        <!-- Icons will be dynamically loaded based on equipment type -->
                    </div>
                </div>
            </div>
            <input type="hidden" name="equipment_icon" id="equipmentIconInput" value="portable.svg">
        </div>

        <div class="row">
            <div class="my-3">
                <label for="location_id" class="form-label">Where is this equipment located?</label>
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
                        @if(isset($locations) && count($locations) > 0)
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
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('account.equipment.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Equipment
            </button>
        </div>
    </form>
</div>

<script>
function showEquipmentIcon() {
    const equipmentIconSection = document.getElementById('equipment-icon-section');
    const equipmentA = document.getElementById('equipment_a');
    const equipmentB = document.getElementById('equipment_b');
    const equipmentC = document.getElementById('equipment_c');

    if (equipmentA.checked || equipmentB.checked || equipmentC.checked) {
        equipmentIconSection.style.display = 'block';
        updateEquipmentIconGrid();
    } else {
        equipmentIconSection.style.display = 'none';
    }
}

function updateEquipmentIconGrid() {
    const equipmentA = document.getElementById('equipment_a');
    const equipmentB = document.getElementById('equipment_b');
    const equipmentC = document.getElementById('equipment_c');
    const iconGrid = document.getElementById('equipmentIconGrid');

    let iconsHTML = '';
    let defaultIcon = '';
    let defaultIconFile = '';

    // Fuel equipment icons
    const fuelIcons = `
        <div class="icon-choice" data-icon="portable.svg" data-label="Portable">
            <img src="/images/admin/equipment/portable.svg" />
        </div>
        <div class="icon-choice" data-icon="s-generator.svg" data-label="Generator Small">
            <img src="/images/admin/equipment/s-generator.svg" />
        </div>
        <div class="icon-choice" data-icon="generator-trailer.svg" data-label="Generator Trailer">
            <img src="/images/admin/equipment/generator-trailer.svg" />
        </div>
    `;

    // Refrigerant equipment icons
    const refrigerantIcons = `
        <div class="icon-choice" data-icon="refrigerator-1.svg" data-label="Refrigerant 1">
            <img src="/images/admin/equipment/refrigerator-1.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-2.svg" data-label="Refrigerator 2">
            <img src="/images/admin/equipment/refrigerator-2.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-3.svg" data-label="Refridgerator 3">
            <img src="/images/admin/equipment/refrigerator-3.svg" />
        </div>
        <div class="icon-choice" data-icon="refrigerator-4.svg" data-label="Refrigerator 4">
            <img src="/images/admin/equipment/refrigerator-4.svg" />
        </div>
        <div class="icon-choice" data-icon="freezer-1.svg" data-label="Freezer 1">
            <img src="/images/admin/equipment/freezer-1.svg" />
        </div>
        <div class="icon-choice" data-icon="freezer-3.svg" data-label="Freezer 3">
            <img src="/images/admin/equipment/freezer-3.svg" />
        </div>
        <div class="icon-choice" data-icon="aircon.svg" data-label="AC">
            <img src="/images/admin/equipment/aircon.svg" />
        </div>
    `;

    // Industrial gas equipment icons
    const gasIcons = `
        <div class="icon-choice" data-icon="gas1.svg" data-label="Gas 1">
            <img src="/images/admin/equipment/gas1.svg" />
        </div>
        <div class="icon-choice" data-icon="gas2.svg" data-label="Gas 2">
            <img src="/images/admin/equipment/gas2.svg" />
        </div>
        <div class="icon-choice" data-icon="gas3.svg" data-label="Gas 3">
            <img src="/images/admin/equipment/gas3.svg" />
        </div>
        <div class="icon-choice" data-icon="gas4.svg" data-label="Gas 4">
            <img src="/images/admin/equipment/gas4.svg" />
        </div>
        <div class="icon-choice" data-icon="gas5.svg" data-label="Gas 5">
            <img src="/images/admin/equipment/gas5.svg" />
        </div>
    `;

    // Combine icons based on selected checkboxes
    if (equipmentA.checked) {
        iconsHTML += fuelIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/portable.svg"/>';
            defaultIconFile = 'portable.svg';
        }
    }

    if (equipmentB.checked) {
        iconsHTML += refrigerantIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/refrigerator-1.svg" />';
            defaultIconFile = 'refrigerator-1.svg';
        }
    }

    if (equipmentC.checked) {
        iconsHTML += gasIcons;
        if (!defaultIcon) {
            defaultIcon = '<img src="/images/admin/equipment/gas1.svg"/>';
            defaultIconFile = 'gas1.svg';
        }
    }

    // Set the combined icons
    iconGrid.innerHTML = iconsHTML;

    // Set the first icon as active
    if (iconGrid.firstElementChild) {
        iconGrid.firstElementChild.classList.add('active');
    }

    // Set default selected icon
    document.getElementById('selectedEquipmentIcon').innerHTML = defaultIcon;
    document.getElementById('equipmentIconInput').value = defaultIconFile;

    attachEquipmentIconListeners();
}

function attachEquipmentIconListeners() {
    const iconChoices = document.querySelectorAll('#equipmentIconGrid .icon-choice');
    const selectedIcon = document.getElementById('selectedEquipmentIcon');
    const equipmentIconInput = document.getElementById('equipmentIconInput');

    iconChoices.forEach(choice => {
        choice.addEventListener('click', function() {
            iconChoices.forEach(c => c.classList.remove('active'));
            this.classList.add('active');
            const iconFilename = this.dataset.icon;
            selectedIcon.innerHTML = `<img src="/images/admin/equipment/${iconFilename}" alt="Selected Equipment" />`;
            equipmentIconInput.value = iconFilename;
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to checkboxes
    const equipmentCheckboxes = document.querySelectorAll('input[name="equipment[]"]');
    equipmentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            showEquipmentIcon();
        });
    });

    // Initialize on page load
    showEquipmentIcon();
});

// Equipment type options based on checkbox selection
const equipmentTypeOptions = {
    fuel: [
        { value: 'boiler', text: 'Boiler' },
        { value: 'burner', text: 'Burner' },
        { value: 'dryer', text: 'Dryer' },
        { value: 'flare', text: 'Flare' },
        { value: 'furnace', text: 'Furnace' },
        { value: 'generator', text: 'Generator' },
        { value: 'heater', text: 'Heater' },
        { value: 'incinerator', text: 'Incinerator' },
        { value: 'internal_combustion_engine', text: 'Internal Combustion Engine' },
        { value: 'kiln', text: 'Kiln' },
        { value: 'open_burning', text: 'Open Burning' },
        { value: 'other', text: 'Other' },
        { value: 'oven', text: 'Oven' },
        { value: 'thermal_oxidizer', text: 'Thermal Oxidizer' },
        { value: 'turbine', text: 'Turbine' }
    ],
    refrigerant: [
        { value: 'chillers', text: 'Chillers' },
        { value: 'domestic_refrigeration', text: 'Domestic Refrigeration' },
        { value: 'industrial_refrigeration', text: 'Industrial Refrigeration including Food Processing and Cold Storage' },
        { value: 'medium_large_commercial_refrigeration', text: 'Medium & Large Commercial Refrigeration' },
        { value: 'mobile_air_conditioning', text: 'Mobile Air Conditioning' },
        { value: 'other', text: 'Other' },
        { value: 'residential_commercial_ac', text: 'Residential & Commercial A/C including Heat Pumps' },
        { value: 'stand_alone_commercial_applications', text: 'Stand Alone Commercial Applications' },
        { value: 'transport_refrigeration', text: 'Transport Refrigeration' }
    ],
    industrial_gas: [
        { value: 'fixed_fire_suppression_equipment', text: 'Fixed Fire Suppression Equipment' },
        { value: 'other', text: 'Other' },
        { value: 'portable_fire_suppression_equipment', text: 'Portable Fire Suppression Equipment' }
    ]
};

// Function to populate dropdown options
function populateEquipmentTypeDropdown(selectedTypes) {
    const dropdown = document.getElementById('equipmentTypeDropdown');
    const dropdownText = document.querySelector('#equipmentTypeSection .dropdown-text');
    const hiddenInput = document.getElementById('type');

    // Clear existing options
    dropdown.innerHTML = '';

    // Determine which options to show based on selected checkboxes
    let optionsToShow = [];

    if (selectedTypes.includes('fuel')) {
        optionsToShow = [...optionsToShow, ...equipmentTypeOptions.fuel];
    }
    if (selectedTypes.includes('refrigerant')) {
        optionsToShow = [...optionsToShow, ...equipmentTypeOptions.refrigerant];
    }
    if (selectedTypes.includes('industrial_gas')) {
        optionsToShow = [...optionsToShow, ...equipmentTypeOptions.industrial_gas];
    }

    // Remove duplicates (in case 'other' appears multiple times)
    const uniqueOptions = optionsToShow.filter((option, index, self) =>
        index === self.findIndex(o => o.value === option.value)
    );

    // Populate dropdown
    uniqueOptions.forEach(option => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.className = 'dropdown-item';
        a.href = '#';
        a.dataset.value = option.value;
        a.textContent = option.text;
        li.appendChild(a);
        dropdown.appendChild(li);
    });


    // Reset dropdown text and value
    dropdownText.textContent = 'Select equipment type';
    hiddenInput.value = '';

    // Reattach event listeners to new dropdown items
    attachDropdownItemListeners();
}

// Function to handle checkbox changes
function handleCheckboxChange() {
    const checkboxes = document.querySelectorAll('input[name="equipment[]"]:checked');
    const selectedTypes = Array.from(checkboxes).map(cb => {
        // Map checkbox values to equipment types
        switch(cb.value) {
            case 'equipment_a': return 'fuel';
            case 'equipment_b': return 'refrigerant';
            case 'equipment_c': return 'industrial_gas';
            default: return null;
        }
    }).filter(type => type !== null);


    if (selectedTypes.length > 0) {
        document.getElementById('equipmentTypeSection').style.display = 'block';
        populateEquipmentTypeDropdown(selectedTypes);
    } else {
        document.getElementById('equipmentTypeSection').style.display = 'none';
    }
}

// Function to attach event listeners to dropdown items
function attachDropdownItemListeners() {
    document.querySelectorAll('#equipmentTypeDropdown .dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.custom-dropdown');
            const toggle = dropdown.querySelector('.custom-dropdown-toggle');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const dropdownText = toggle.querySelector('.dropdown-text');

            // Update the button text
            dropdownText.textContent = this.textContent;

            // Update the hidden input value
            hiddenInput.value = this.dataset.value;

            // Close the dropdown
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // Handle location dropdown items
    document.querySelectorAll('.custom-dropdown .dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.custom-dropdown');
            const toggle = dropdown.querySelector('.custom-dropdown-toggle');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const dropdownText = toggle.querySelector('.dropdown-text');

            // Get location name from the location-option structure
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
}

// Custom dropdown functionality
document.addEventListener('DOMContentLoaded', function() {

    // Handle location dropdown specifically
    const locationToggle = document.getElementById('locationDropdownToggle');
    if (locationToggle) {
        locationToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdownMenu = document.getElementById('locationDropdownMenu');
            const isOpen = dropdownMenu.classList.contains('show');

            // Close all other dropdowns first
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            });

            // Toggle location dropdown
            if (!isOpen) {
                dropdownMenu.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    }

    // Handle checkbox changes
    document.querySelectorAll('input[name="equipment[]"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            handleCheckboxChange();
        });
    });

    // Handle dropdown toggle
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
});
</script>
@endsection
