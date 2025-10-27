@extends('account.layout')

@section('title', 'Add Location')


@section('content')
<div class="content-body">
    {{-- Form Type Indicator --}}
    <div class="mb-4">
        @if(request('type') === 'multiple')
            <div class="alert alert-info">
                <i class="fas fa-list"></i> <strong>Multiple Locations Mode</strong> - Add multiple locations at once using the table below.
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-map-marker-alt"></i> <strong>Single Location Mode</strong> - Add one location with detailed information and map selection.
            </div>
        @endif
    </div>

    {{-- Single Location Form --}}
    @if(request('type') !== 'multiple')
    <div id="single-location-form">
        <form action="{{ route('account.locations.store') }}" method="POST">
            @csrf

        <div class="text-center">
            <div class="admin-header">Add a Location</div>
            <p>Add a location to your 2024 reporting year. These include physical places you own, rent, or lease.
            Learn more</p>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="name" class="form-label">What is the name of this location?</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <h6 style="font-size: .75rem;">Give this location a name or ID number to make it easier to identify it later.</h6>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-3">
                    <label for="city" class="form-label">Search for the address to autofill.</label>
                     <div class="position-relative">
                    <input type="text" class="form-control @error('city') is-invalid @enderror"
                                id="city" name="city" value="{{ old('city') }}" required
                                placeholder="Type city name (e.g., Bangsar, Butterworth, Kuala Lumpur)"
                                autocomplete="off">
                         <div id="city-suggestions" class="autocomplete-suggestions"></div>
                     </div>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row" style="background: lightgrey; border-radius: 15px; padding: 1rem;">
                <div class="col-md-12">
                <div class="mb-3">
                    <label for="country" class="form-label">Country *</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror"
                           id="country" name="country" value="{{ old('country') }}" required>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="state" class="form-label">State *</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror"
                           id="state" name="state" value="{{ old('state') }}" required>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Postal Code</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror"
                           id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                    @error('postal_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="my-3">
             <button id="toggle-btn">I can't find my exact address</button>
            <div id="guidance-text" style="display: none; ">
                We use Google Maps to match addresses in our platform. Sometimes in rare cases it struggles to find a match on exact street addresses.
                <br>
                The most important location elements for carbon accounting are city, state and zip. Try searching for those in the address bar (ex: Jackson, Wyoming 83001) and selecting the general location match there.
            </div>
        </div>

        <div class="mt-3">
            <label for="utilities" class="form-label">In addition to electricity, does your location use any of the other following utilities?(Optional)</label>
            <div class="checkbox">
                <div class="">
                    <label class="checkbox-label">
                        <input type="checkbox" id="toggle-check">
                        <div class="text-content">
                        <span id="label-text">This location also uses natural gas</span>
                        <h6>Natural gas is a common fuel type used in many buildings around the world for heating purposes.</h6>
                        </div>
                    </label>

                    <label class="checkbox-label">
                        <input type="checkbox" id="toggle-check">
                        <div class="text-content">
                        <span id="label-text">This location also uses heat & steam</span>
                        <h6>Heat and steam bought from a third-party supplier and delivered to your locations, typically via district heating or heated water. While less common globally than onsite natural gas, it is widely used in certain regions.</h6>
                        </div>
                    </label>

                    <label class="checkbox-label">
                        <input type="checkbox" id="toggle-check">
                        <div class="text-content">
                        <span id="label-text">This location also uses purchased cooling</span>
                        <h6>Purchased cooling is rarely used (< 2% of locations). It involves buying chilled water for cooling and is NOT the same as traditional air conditioning, which relies on purchased electricity and refrigerants.</h6>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label for="gross" class="form-label">What is the gross area of this location?</label>
            <div class="input-group">
                <!-- Number input -->
                <input type="number"
                    class="form-control @error('gross') is-invalid @enderror"
                    id="gross"
                    name="gross"
                    value="{{ old('gross') }}"
                    required
                    placeholder="Enter area">

                <!-- Dropdown for units -->
                <select class="form-select" id="unit" name="unit" required>
                <option value="sqft" {{ old('unit') == 'sqft' ? 'selected' : '' }}>sqft - square foot</option>
                <option value="sqm" {{ old('unit') == 'sqm' ? 'selected' : '' }}>sqm - square meter</option>
                </select>
            </div>

            @error('gross')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <h6 class="mt-2" style="font-size: .75rem;">It’s okay if this is an estimate</h6>
        </div>

        <div class="mt-3">
            <label for="primary" class="form-label">What is this location's primary use?</label>
            <div class="input-group">
                <select class="form-select custom-select" id="primary" name="primary" required>
                <option value="banking" {{ old('primary') == 'banking' ? 'selected' : '' }}>Banking & Financial Services</option>
                <option value="education" {{ old('primary') == 'education' ? 'selected' : '' }}>Education</option>
                <option value="entertainment" {{ old('primary') == 'entertainment' ? 'selected' : '' }}>Entertainment & Public Assembly</option>
                <option value="food_sales" {{ old('primary') == 'food_sales' ? 'selected' : '' }}>Food Sales</option>
                <option value="food_service" {{ old('primary') == 'food_service' ? 'selected' : '' }}>Food Service</option>
                <option value="healthcare" {{ old('primary') == 'healthcare' ? 'selected' : '' }}>Healthcare</option>
                <option value="lodging" {{ old('primary') == 'lodging' ? 'selected' : '' }}>Lodging</option>
                <option value="manufacturing" {{ old('primary') == 'manufacturing' ? 'selected' : '' }}>Manufacturing & Industrial</option>
                <option value="mixed_use" {{ old('primary') == 'mixed_use' ? 'selected' : '' }}>Mixed Use</option>
                <option value="office" {{ old('primary') == 'office' ? 'selected' : '' }}>Office</option>
                <option value="oil_gas" {{ old('primary') == 'oil_gas' ? 'selected' : '' }}>Oil & Natural Gas</option>
                <option value="parking" {{ old('primary') == 'parking' ? 'selected' : '' }}>Parking</option>
                <option value="public_services" {{ old('primary') == 'public_services' ? 'selected' : '' }}>Public Services</option>
                <option value="religious" {{ old('primary') == 'religious' ? 'selected' : '' }}>Religious Worship</option>
                <option value="retail" {{ old('primary') == 'retail' ? 'selected' : '' }}>Retail/Merchantile</option>
                <option value="services" {{ old('primary') == 'services' ? 'selected' : '' }}>Services</option>
                <option value="tech_science" {{ old('primary') == 'tech_science' ? 'selected' : '' }}>Technology & Science</option>
                <option value="utility" {{ old('primary') == 'utility' ? 'selected' : '' }}>Utility</option>
                <option value="vacant" {{ old('primary') == 'vacant' ? 'selected' : '' }}>Vacant</option>
                <option value="warehouse" {{ old('primary') == 'warehouse' ? 'selected' : '' }}>Warehouse & Storage</option>
                </select>
            </div>
        </div>

        {{-- <div class="mb-3">
            <label class="form-label">Location on Map</label>
            <p class="text-muted small">Click on the map to set the location coordinates</p>
            <div class="map-container" style="height: 300px; border-radius: 10px; overflow: hidden; border: 1px solid #e9ecef;">
                <div id="map"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                           id="latitude" name="latitude" value="{{ old('latitude', request('lat')) }}" readonly>
                    @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                           id="longitude" name="longitude" value="{{ old('longitude', request('lng')) }}" readonly>
                    @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div> --}}

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('account.locations.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save
            </button>
        </div>
        </form>
    </div>
    @endif

    {{-- Multiple Locations Form --}}
    @if(request('type') === 'multiple')
    <div id="multiple-locations-form">
        <div class="text-center">
            <div class="admin-header">Add multiple locations</div>
            <p style="padding: 0rem 5rem;">Upload multiple locations at once. You can always download the locations data below to share with others or come back to this screen to re-upload your data at a later point in time.<br> <a href="">Learn more about how to add multiple locations</a></p>
        </div>

        {{-- Scrollable Table Container --}}
        <div class="table-container" style="max-height: 300px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 8px;">
            <table class="table table-bordered table-sm mb-0">
                <thead class="table-light sticky-top">
                    <tr>
                        <th style="min-width: 150px;">Location name</th>
                        <th style="min-width: 200px;">Address</th>
                        <th style="min-width: 120px;">Uses Natural Gas</th>
                        <th style="min-width: 140px;">Uses Heat and Steam</th>
                        <th style="min-width: 120px;">Uses Cooling</th>
                        <th style="min-width: 120px;">Primary Use</th>
                        <th style="min-width: 120px;">Primary Use (cont.)</th>
                        <th style="min-width: 100px;">Gross Area</th>
                        <th style="min-width: 100px;">Gross Area UOM</th>
                        <th style="min-width: 120px;">Tags</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][name]"></td>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][address]"></td>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input table-checkbox" name="locations[{{ $i }}][natural_gas]" value="1">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input table-checkbox" name="locations[{{ $i }}][heat_steam]" value="1">
                            </td>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input table-checkbox" name="locations[{{ $i }}][cooling]" value="1">
                            </td>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][primary_use]"></td>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][primary_use_cont]"></td>
                            <td><input type="number" class="form-control form-control-sm" name="locations[{{ $i }}][gross_area]"></td>
                            <td>
                                <select class="form-select form-select-sm" name="locations[{{ $i }}][gross_area_uom]">
                                    <option value="">Select</option>
                                    <option value="sqft">sqft</option>
                                    <option value="sqm">sqm</option>
                                    <option value="acres">acres</option>
                                    <option value="hectares">hectares</option>
                                </select>
                            </td>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][tags]"></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        {{-- Footer Section with Submit Button --}}
        <div class="mt-4 p-3">
            <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Submit Multiple Locations
                    </button>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Sticky Continue Footer -->
<div class="sticky-continue-footer">
    <div class="container-fluid">
        <div class="d-flex justify-content-center">
            <a href="{{ route('account.vehicles.create') }}" class="btn btn-success btn-lg">
                Continue to Vehicles <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Malaysian locations database
    const malaysianLocations = {
        // Kuala Lumpur
        'kuala lumpur': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '50000', lat: 3.1390, lng: 101.6869 },
        'bangsar': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '59000', lat: 3.1285, lng: 101.6670 },
        'bangsar south': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '59200', lat: 3.1185, lng: 101.6670 },
        'mont kiara': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '50480', lat: 3.1728, lng: 101.6508 },
        'bukit bintang': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '55100', lat: 3.1478, lng: 101.7123 },
        'bukit jalil': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '57000', lat: 3.0319, lng: 101.6981 },
        'cheras': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '56000', lat: 3.0319, lng: 101.7622 },
        'ampang': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '68000', lat: 3.1478, lng: 101.7619 },

        // Selangor
        'petaling jaya': { state: 'Selangor', country: 'Malaysia', postal: '46000', lat: 3.1073, lng: 101.6067 },
        'puchong': { state: 'Selangor', country: 'Malaysia', postal: '47100', lat: 3.0319, lng: 101.6069 },
        'subang jaya': { state: 'Selangor', country: 'Malaysia', postal: '47500', lat: 3.0733, lng: 101.5185 },
        'shah alam': { state: 'Selangor', country: 'Malaysia', postal: '40000', lat: 3.0733, lng: 101.5185 },
        'klang': { state: 'Selangor', country: 'Malaysia', postal: '41000', lat: 3.0319, lng: 101.4444 },
        'kajang': { state: 'Selangor', country: 'Malaysia', postal: '43000', lat: 2.9922, lng: 101.7904 },
        'cyberjaya': { state: 'Selangor', country: 'Malaysia', postal: '63000', lat: 2.9213, lng: 101.6559 },
        'kota kemuning': { state: 'Selangor', country: 'Malaysia', postal: '40460', lat: 3.0319, lng: 101.5319 },
        'bangi': { state: 'Selangor', country: 'Malaysia', postal: '43650', lat: 2.9264, lng: 101.7904 },
        'putrajaya': { state: 'Putrajaya', country: 'Malaysia', postal: '62000', lat: 2.9264, lng: 101.6964 },

        // Penang
        'georgetown': { state: 'Penang', country: 'Malaysia', postal: '10000', lat: 5.4164, lng: 100.3327 },
        'penang': { state: 'Penang', country: 'Malaysia', postal: '10000', lat: 5.4164, lng: 100.3327 },
        'butterworth': { state: 'Penang', country: 'Malaysia', postal: '12300', lat: 5.3991, lng: 100.3635 },
        'bayan lepas': { state: 'Penang', country: 'Malaysia', postal: '11900', lat: 5.2946, lng: 100.2676 },
        'bukit mertajam': { state: 'Penang', country: 'Malaysia', postal: '14000', lat: 5.3617, lng: 100.4718 },
        'pulau pinang': { state: 'Penang', country: 'Malaysia', postal: '10000', lat: 5.4164, lng: 100.3327 },

        // Johor
        'johor bahru': { state: 'Johor', country: 'Malaysia', postal: '80000', lat: 1.4927, lng: 103.7414 },
        'jb': { state: 'Johor', country: 'Malaysia', postal: '80000', lat: 1.4927, lng: 103.7414 },
        'skudai': { state: 'Johor', country: 'Malaysia', postal: '81300', lat: 1.5351, lng: 103.6370 },
        'iskandar puteri': { state: 'Johor', country: 'Malaysia', postal: '79100', lat: 1.4655, lng: 103.6057 },
        'nusajaya': { state: 'Johor', country: 'Malaysia', postal: '79100', lat: 1.4655, lng: 103.6057 },

        // Perak
        'ipoh': { state: 'Perak', country: 'Malaysia', postal: '30000', lat: 4.5975, lng: 101.0901 },
        'taiping': { state: 'Perak', country: 'Malaysia', postal: '34000', lat: 4.8500, lng: 100.7333 },
        'teluk intan': { state: 'Perak', country: 'Malaysia', postal: '36000', lat: 4.0225, lng: 101.0218 },

        // Sabah
        'kota kinabalu': { state: 'Sabah', country: 'Malaysia', postal: '88000', lat: 5.9804, lng: 116.0735 },  'kk': { state: 'Sabah', country: 'Malaysia', postal: '88000', lat: 5.9804, lng: 116.0735 },
        'sandakan': { state: 'Sabah', country: 'Malaysia', postal: '90000', lat: 5.8402, lng: 118.1179 },
        'kota belud': { state: 'Sabah', country: 'Malaysia', postal: '89150', lat: 6.3264, lng: 116.4319 },

        // Sarawak
        'kuching': { state: 'Sarawak', country: 'Malaysia', postal: '93000', lat: 1.5533, lng: 110.3592 },
        'miri': { state: 'Sarawak', country: 'Malaysia', postal: '98000', lat: 4.3947, lng: 113.9918 },
        'sibu': { state: 'Sarawak', country: 'Malaysia', postal: '96000', lat: 2.3000, lng: 111.8167 },

        // Other states
        'malacca': { state: 'Melaka', country: 'Malaysia', postal: '75000', lat: 2.2055, lng: 102.2501 },
        'melaka': { state: 'Melaka', country: 'Malaysia', postal: '75000', lat: 2.2055, lng: 102.2501 },
        'alor setar': { state: 'Kedah', country: 'Malaysia', postal: '05000', lat: 6.1248, lng: 100.3678 },
        'kota bharu': { state: 'Kelantan', country: 'Malaysia', postal: '15000', lat: 6.1254, lng: 102.2386 },
        'kuantan': { state: 'Pahang', country: 'Malaysia', postal: '25000', lat: 3.8077, lng: 103.3260 },
        'kuala terengganu': { state: 'Terengganu', country: 'Malaysia', postal: '20000', lat: 5.3302, lng: 103.1408 },
        'seremban': { state: 'Negeri Sembilan', country: 'Malaysia', postal: '70000', lat: 2.7297, lng: 101.9381 }
    };

    // Function to update address fields
    function updateAddressFields(country, state, postal) {
        const countryField = document.getElementById('country');
        const stateField = document.getElementById('state');
        const postalField = document.getElementById('postal_code');

        console.log('Updating fields:', { country, state, postal });
        console.log('Field elements:', { countryField, stateField, postalField });

        if (countryField) {
            countryField.value = country;
            console.log('Updated country to:', country);
        }
        if (stateField) {
            stateField.value = state;
            console.log('Updated state to:', state);
        }
        if (postalField) {
            postalField.value = postal;
            console.log('Updated postal to:', postal);
        }
    }

    // Function to search Malaysian locations
    function searchMalaysianLocation(query) {
        const normalizedQuery = query.toLowerCase().trim();

        // Direct match
        if (malaysianLocations[normalizedQuery]) {
            return malaysianLocations[normalizedQuery];
        }

        // Partial match
        for (const [key, location] of Object.entries(malaysianLocations)) {
            if (key.includes(normalizedQuery) || normalizedQuery.includes(key)) {
                return location;
            }
        }

        return null;
    }

    // Function to get suggestions
    function getSuggestions(query) {
        const normalizedQuery = query.toLowerCase().trim();
        const suggestions = [];
        const seen = new Set(); // Track unique combinations

        if (normalizedQuery.length < 1) return suggestions;

        for (const [key, location] of Object.entries(malaysianLocations)) {
            if (key.startsWith(normalizedQuery) || key.includes(normalizedQuery)) {
                // Create unique identifier to avoid duplicates
                const uniqueId = `${key}-${location.state}-${location.postal}`;

                if (!seen.has(uniqueId)) {
                    seen.add(uniqueId);
                    suggestions.push({
                        name: key,
                        displayName: key.charAt(0).toUpperCase() + key.slice(1),
                        state: location.state,
                        location: location
                    });
                }
            }
        }

        // Sort by relevance (starts with query first, then contains)
        suggestions.sort((a, b) => {
            const aStarts = a.name.startsWith(normalizedQuery);
            const bStarts = b.name.startsWith(normalizedQuery);

            if (aStarts && !bStarts) return -1;
            if (!aStarts && bStarts) return 1;

            return a.name.localeCompare(b.name);
        });

        return suggestions.slice(0, 8); // Limit to 8 suggestions
    }

    // Function to show suggestions
    function showSuggestions(suggestions) {
        const suggestionsContainer = document.getElementById('city-suggestions');

        if (suggestions.length === 0) {
            suggestionsContainer.classList.remove('show');
            return;
        }

        const html = suggestions.map((suggestion, index) => `
            <div class="suggestion-item" data-index="${index}" data-city="${suggestion.name}">
                <div class="city-name">${suggestion.displayName}</div>
            </div>
        `).join('');

        suggestionsContainer.innerHTML = html;
        suggestionsContainer.style.display = 'block';
        suggestionsContainer.classList.add('show');

        // Add click handlers
        suggestionsContainer.querySelectorAll('.suggestion-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const cityName = this.dataset.city;
                const location = malaysianLocations[cityName];

                if (location) {
                    // Set flag to prevent input event from showing suggestions again
                    justSelected = true;

                    // Hide suggestions immediately
                    suggestionsContainer.classList.remove('show');
                    suggestionsContainer.style.display = 'none';

                    // Update input field
                    addressInput.value = cityName.charAt(0).toUpperCase() + cityName.slice(1);

                    // Update address fields
                    updateAddressFields(location.country, location.state, location.postal);
                }
            });
        });
    }

    // Function to hide suggestions
    function hideSuggestions() {
        const suggestionsContainer = document.getElementById('city-suggestions');
        setTimeout(() => {
            suggestionsContainer.classList.remove('show');
            suggestionsContainer.style.display = 'none';
        }, 200); // Delay to allow click events
    }

    // Address search functionality
    const addressInput = document.getElementById('city');
    let searchTimeout;
    let justSelected = false; // Flag to prevent showing suggestions after selection

    console.log('Address input field:', addressInput);

    if (addressInput) {
        addressInput.addEventListener('input', function(e) {
            const query = e.target.value;
            console.log('Search query:', query);

            // Clear previous timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }

            // Don't show suggestions if we just selected something
            if (justSelected) {
                justSelected = false;
                return;
            }

            // Show suggestions immediately for better UX
            if (query.length >= 1) {
                const suggestions = getSuggestions(query);
                showSuggestions(suggestions);
            } else {
                hideSuggestions();
            }

            // Debounce search for auto-fill
            searchTimeout = setTimeout(() => {
                if (query.length >= 3) {
                    console.log('Searching for:', query);
                    // First try Malaysian locations database
                    const malaysianLocation = searchMalaysianLocation(query);

                    if (malaysianLocation) {
                        console.log('Found Malaysian location:', malaysianLocation);
                        // Update address fields
                        updateAddressFields(
                            malaysianLocation.country,
                            malaysianLocation.state,
                            malaysianLocation.postal
                        );
                    }
                }
            }, 500); // 500ms delay
        });

        // Handle blur event to hide suggestions
        addressInput.addEventListener('blur', function() {
            // Use a longer delay to ensure click events on suggestions work
            setTimeout(() => {
                const suggestionsContainer = document.getElementById('city-suggestions');
                suggestionsContainer.classList.remove('show');
                suggestionsContainer.style.display = 'none';
            }, 150);
        });

        // Handle focus event to show suggestions if there's text
        addressInput.addEventListener('focus', function() {
            const query = this.value;
            if (query.length >= 1) {
                const suggestions = getSuggestions(query);
                showSuggestions(suggestions);
            }
        });
    }

    const toggleBtn = document.getElementById("toggle-btn");
    const guidanceText = document.getElementById("guidance-text");

    if (toggleBtn && guidanceText) {
    toggleBtn.addEventListener("click", () => {
      if (guidanceText.style.display === "none" || guidanceText.style.display === "") {
        guidanceText.style.display = "block";
        toggleBtn.textContent = "Hide address guidance";
      } else {
        guidanceText.style.display = "none";
            toggleBtn.textContent = "I can't find my exact address";
      }
    });
    }
});
</script>
@endsection
