@extends('admin.layout')

@section('title', 'Add Location')

@section('content')
<div class="content-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3 mb-0">Add New Location</h1>
            <p class="text-muted mb-0">Create and manage facility locations</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.locations.create') }}" class="btn btn-outline-primary {{ request('type') !== 'multiple' ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i> Single
            </a>
            <a href="{{ route('admin.locations.create', ['type' => 'multiple']) }}" class="btn btn-outline-primary {{ request('type') === 'multiple' ? 'active' : '' }}">
                <i class="fas fa-list"></i> Multiple
            </a>
            <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Locations
            </a>
        </div>
    </div>
</div>

<div class="content-body">
    <style>
        .section-card { border: none; border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.06); }
        .section-card .card-title { font-weight: 600; }
        .helper { color: #6c757d; font-size: 0.9rem; }
        .map-container { height: 360px; border-radius: 10px; overflow: hidden; border: 1px solid #e9ecef; }
        .sticky-action { position: sticky; bottom: 0; background: #fff; border-top: 1px solid #e9ecef; border-radius: 8px; }
        .badge-mode { font-weight: 600; }
        .leaflet-control-geocoder-form input { box-shadow: none !important; }
    </style>

    <div class="mb-4">
        @if(request('type') === 'multiple')
            <div class="alert alert-info d-flex align-items-center gap-2">
                <i class="fas fa-list"></i>
                <div>
                    <strong>Multiple Locations Mode</strong> — Add multiple locations at once using the table below.
                </div>
            </div>
        @else
            <div class="alert alert-info d-flex align-items-center gap-2">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <strong>Single Location Mode</strong> — Add one location with details and map selection.
                </div>
            </div>
        @endif
    </div>

    {{-- Single Location Form --}}
    @if(request('type') !== 'multiple')
    <div id="single-location-form">
        <form action="{{ route('admin.locations.store') }}" method="POST">
            @csrf
        <div class="card section-card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Location Details</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Location Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="helper mt-1">Give this location a name or ID to identify it later.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="primary_use" class="form-label">Primary Use</label>
                            <select id="primary_use" name="primary_use" class="form-select js-select2" data-placeholder="Select primary use">
                                <option value="">Select primary use</option>
                                @php($primaryUses = ['Office','Manufacturing','Warehouse','Retail','Data Center','Healthcare','Education','Hospitality','Residential','Other'])
                                @foreach($primaryUses as $use)
                                    <option value="{{ $use }}" {{ old('primary_use')===$use ? 'selected' : '' }}>{{ $use }}</option>
                                @endforeach
                            </select>
                            <div class="helper mt-1">The main purpose or type of this facility.</div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address *</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="city" class="form-label">City *</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror"
                                   id="city" name="city" value="{{ old('city') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="state" class="form-label">State/Region *</label>
                            <select id="state" name="state" class="form-select js-select2 @error('state') is-invalid @enderror" data-placeholder="Select state/region" required>
                                @php($states = ['Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington','West Virginia','Wisconsin','Wyoming','Other'])
                                <option value="">Select state/region</option>
                                @foreach($states as $s)
                                    <option value="{{ $s }}" {{ old('state')===$s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="country" class="form-label">Country *</label>
                            <select id="country" name="country" class="form-select js-select2 @error('country') is-invalid @enderror" data-placeholder="Select country" required>
                                @php($countries = ['United States','Canada','United Kingdom','Australia','Germany','France','India','Japan','Malaysia','Singapore','Other'])
                                <option value="">Select country</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c }}" {{ old('country')===$c ? 'selected' : '' }}>{{ $c }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" name="tags" value="{{ old('tags') }}" placeholder="Comma-separated, e.g. HQ, Renewable">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card section-card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-2">Location on Map</h5>
                <p class="helper mb-3">Use search or click on the map to set coordinates.</p>
                <div class="map-container">
                    <div id="map"></div>
                </div>
                <div class="mt-2">
                    <button type="button" id="toggle-guidance" class="btn btn-link p-0">I can't find my exact address</button>
                    <div id="guidance" class="mt-2" style="display:none;">
                        <small class="text-muted">We use OpenStreetMap data for search. If a precise street address is hard to match, try searching for city, state and postal code (e.g., Jackson, Wyoming 83001) and then click the map to fine tune the marker.</small>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                               id="latitude" name="latitude" value="{{ old('latitude', request('lat')) }}" readonly>
                        @error('latitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                               id="longitude" name="longitude" value="{{ old('longitude', request('lng')) }}" readonly>
                        @error('longitude')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card section-card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-2">Additional Details</h5>
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                          id="description" name="description" rows="4" placeholder="Notes about this location (optional)">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.locations.index') }}" class="btn btn-outline-secondary me-2">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Create Location
            </button>
        </div>
        </form>
    </div>
    @endif

    {{-- Multiple Locations Form --}}
    @if(request('type') === 'multiple')
    <div id="multiple-locations-form">
        <div class="mb-4">
            <h5>Add multiple locations</h5>
            <p class="text-muted">Upload multiple locations at once. You can always download the locations data below to share with others or come back to this screen to re-upload your data at a later point in time.</p>
            <p><a href="#" class="text-primary">Learn more about how to add multiple locations</a></p>
        </div>

        <div class="table-container" style="max-height: 340px; overflow-y: auto; border: 1px solid #dee2e6; border-radius: 8px;">
            <table class="table table-bordered table-sm mb-0 align-middle">
                <thead class="table-light sticky-top">
                    <tr>
                        <th style="min-width: 160px;">Location name</th>
                        <th style="min-width: 220px;">Address</th>
                        <th style="min-width: 120px;">Uses Natural Gas</th>
                        <th style="min-width: 140px;">Uses Heat and Steam</th>
                        <th style="min-width: 120px;">Uses Cooling</th>
                        <th style="min-width: 160px;">Primary Use</th>
                        <th style="min-width: 140px;">Gross Area</th>
                        <th style="min-width: 140px;">Gross Area UOM</th>
                        <th style="min-width: 160px;">Country</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                        <tr>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][name]" placeholder="Location name"></td>
                            <td><input type="text" class="form-control form-control-sm" name="locations[{{ $i }}][address]" placeholder="Address"></td>
                            <td>
                                <select class="form-select form-select-sm" name="locations[{{ $i }}][natural_gas]">
                                    <option value="">Select</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm" name="locations[{{ $i }}][heat_steam]">
                                    <option value="">Select</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm" name="locations[{{ $i }}][cooling]">
                                    <option value="">Select</option>
                                    <option value="Y">Yes</option>
                                    <option value="N">No</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm js-select2-sm" name="locations[{{ $i }}][primary_use]">
                                    <option value="">Select use</option>
                                    @foreach(['Office','Manufacturing','Warehouse','Retail','Data Center','Healthcare','Education','Hospitality','Residential','Other'] as $use)
                                        <option value="{{ $use }}">{{ $use }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" class="form-control form-control-sm" name="locations[{{ $i }}][gross_area]" placeholder="Area"></td>
                            <td>
                                <select class="form-select form-select-sm js-select2-sm" name="locations[{{ $i }}][gross_area_uom]">
                                    <option value="">Select</option>
                                    <option value="sqft">sqft</option>
                                    <option value="sqm">sqm</option>
                                    <option value="acres">acres</option>
                                    <option value="hectares">hectares</option>
                                </select>
                            </td>
                            <td>
                                <select class="form-select form-select-sm js-select2-sm" name="locations[{{ $i }}][country]">
                                    <option value="">Select country</option>
                                    @foreach(['United States','Canada','United Kingdom','Australia','Germany','France','India','Japan','Malaysia','Singapore','Other'] as $c)
                                        <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>

        <div class="mt-4 p-3 bg-light rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Fill in the details for each location. Empty rows will be ignored.</small>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-secondary">
                        <i class="fas fa-download"></i> Download Template
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Submit Multiple Locations
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const defaultLat = urlParams.get('lat') ? parseFloat(urlParams.get('lat')) : 3.1390;
    const defaultLng = urlParams.get('lng') ? parseFloat(urlParams.get('lng')) : 101.6869;

    const mapEl = document.getElementById('map');
    if (!mapEl) return;

    const map = L.map('map').setView([defaultLat, defaultLng], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    let marker = null;

    function setMarker(lat, lng, openPopup = false) {
        if (marker) map.removeLayer(marker);
        marker = L.marker([lat, lng]).addTo(map);
        if (openPopup) {
            marker.bindPopup(`Location: ${lat.toFixed(6)}, ${lng.toFixed(6)}`).openPopup();
        }
        updateCoordinates(lat, lng);
        reverseGeocode(lat, lng);
    }

    function updateCoordinates(lat, lng) {
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');
        if (latInput) latInput.value = (lat ?? '').toFixed ? (lat).toFixed(6) : (lat ?? '');
        if (lngInput) lngInput.value = (lng ?? '').toFixed ? (lng).toFixed(6) : (lng ?? '');
    }

    async function reverseGeocode(lat, lng) {
        try {
            const res = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`);
            const data = await res.json();
            if (!data || !data.address) return;
            const addr = data.address;
            const addressField = document.getElementById('address');
            const cityField = document.getElementById('city');
            const stateField = document.getElementById('state');
            const countryField = document.getElementById('country');
            const postalField = document.getElementById('postal_code');
            if (addressField && !addressField.value) addressField.value = data.display_name || '';
            if (cityField && !cityField.value) cityField.value = addr.city || addr.town || addr.village || addr.county || '';
            if (stateField) {
                const stateVal = addr.state || '';
                // Try to select matching option if present
                const stateOption = [...stateField.options].find(o => o.text === stateVal);
                if (stateOption) stateField.value = stateOption.value;
            }
            if (countryField) {
                const countryVal = addr.country || '';
                const countryOption = [...countryField.options].find(o => o.text === countryVal);
                if (countryOption) countryField.value = countryOption.value;
            }
            if (postalField && !postalField.value) postalField.value = addr.postcode || '';
            // Refresh Select2 selections
            if (window.$) {
                $('#state').trigger('change');
                $('#country').trigger('change');
            }
        } catch (e) {
            // ignore network errors silently
        }
    }

    // Init geocoder control
    if (L.Control.Geocoder) {
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        })
        .on('markgeocode', function(e) {
            const center = e.geocode.center;
            map.setView(center, 16);
            setMarker(center.lat, center.lng, true);
        })
        .addTo(map);
    }

    // Click to set marker
    map.on('click', function(e) {
        const { lat, lng } = e.latlng;
        setMarker(lat, lng, true);
    });

    // If default coordinates present, drop a marker
    if (defaultLat && defaultLng) {
        setMarker(defaultLat, defaultLng, true);
    }

    // Try to use browser geolocation to improve starting view
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(pos) {
            const lat = pos.coords.latitude;
            const lng = pos.coords.longitude;
            map.setView([lat, lng], 15);
        });
    }

    // Guidance toggle
    const toggleBtn = document.getElementById('toggle-guidance');
    const guidance = document.getElementById('guidance');
    if (toggleBtn && guidance) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = guidance.style.display === 'none' || guidance.style.display === '';
            guidance.style.display = isHidden ? 'block' : 'none';
            toggleBtn.textContent = isHidden ? 'Hide address guidance' : "I can't find my exact address";
        });
    }

    // Initialize Select2
    if (window.$) {
        $('#country, #state, #primary_use').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: function(){ return $(this).data('placeholder') || ''; },
            allowClear: true
        });
        $('.js-select2-sm').select2({
            theme: 'bootstrap-5',
            width: 'resolve',
            minimumResultsForSearch: 5,
            dropdownAutoWidth: true
        });
    }
});
</script>
@endpush
@endsection

