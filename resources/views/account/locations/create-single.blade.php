@extends('account.layout')

@section('title', 'Add Single Location')

@section('content')
<div class="content-body">
    <div class="mb-4">
        <div class="alert alert-info">
            <i class="fas fa-map-marker-alt"></i> <strong>Single Location Mode</strong> - Add one location with detailed information.
        </div>
    </div>

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
                    We use Google Maps to match addresses in our platform. Sometimes in rare cases it struggles to find a match on exact street addresses. <br>
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
                    <input type="number" class="form-control @error('gross') is-invalid @enderror"
                           id="gross" name="gross" value="{{ old('gross') }}" required placeholder="Enter area">
                    <!-- Dropdown for units (custom) -->
                    <div class="custom-dropdown" style="min-width: 240px;">
                        <button type="button" class="custom-dropdown-toggle" id="unitDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @if(old('unit') == 'sqm')
                                    sqm - square meter
                                @else
                                    {{ old('unit') == 'sqft' ? 'sqft - square foot' : 'Select unit' }}
                                @endif
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="unit" name="unit" value="{{ old('unit') ?: '' }}" required>
                        <ul class="dropdown-menu" id="unitDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="sqft">sqft - square foot</a></li>
                            <li><a class="dropdown-item" href="#" data-value="sqm">sqm - square meter</a></li>
                        </ul>
                    </div>
                </div>
                @error('gross')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <h6 class="mt-2">It's okay if this is an estimate</h6>
            </div>

            <div class="mt-3">
                <label for="primary" class="form-label">What is this location's primary use?</label>
                <div class="input-group">
                    <div class="custom-dropdown" style="min-width: 320px;">
                        <button type="button" class="custom-dropdown-toggle" id="primaryDropdownToggle" aria-expanded="false">
                            <span class="dropdown-text">
                                @php
                                    $primaryMap = [
                                        '' => 'Please select a primary use',
                                        'banking' => 'Banking & Financial Services',
                                        'education' => 'Education',
                                        'entertainment' => 'Entertainment & Public Assembly',
                                        'food_sales' => 'Food Sales',
                                        'food_service' => 'Food Service',
                                        'healthcare' => 'Healthcare',
                                        'lodging' => 'Lodging',
                                        'manufacturing' => 'Manufacturing & Industrial',
                                        'mixed_use' => 'Mixed Use',
                                        'office' => 'Office',
                                        'oil_gas' => 'Oil & Natural Gas',
                                        'parking' => 'Parking',
                                        'public_services' => 'Public Services',
                                        'religious' => 'Religious Worship',
                                        'retail' => 'Retail/Merchantile',
                                        'services' => 'Services',
                                        'tech_science' => 'Technology & Science',
                                        'utility' => 'Utility',
                                        'vacant' => 'Vacant',
                                        'warehouse' => 'Warehouse & Storage'
                                    ];
                                    $oldPrimary = old('primary');
                                @endphp
                                {{ $primaryMap[$oldPrimary ?? ''] ?? 'Please select a primary use' }}
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <input type="hidden" id="primary" name="primary" value="{{ old('primary') ?: '' }}" required>
                        <ul class="dropdown-menu" id="primaryDropdownMenu">
                            <li><a class="dropdown-item" href="#" data-value="">Please select a primary use</a></li>
                            <li><a class="dropdown-item" href="#" data-value="banking">Banking & Financial Services</a></li>
                            <li><a class="dropdown-item" href="#" data-value="education">Education</a></li>
                            <li><a class="dropdown-item" href="#" data-value="entertainment">Entertainment & Public Assembly</a></li>
                            <li><a class="dropdown-item" href="#" data-value="food_sales">Food Sales</a></li>
                            <li><a class="dropdown-item" href="#" data-value="food_service">Food Service</a></li>
                            <li><a class="dropdown-item" href="#" data-value="healthcare">Healthcare</a></li>
                            <li><a class="dropdown-item" href="#" data-value="lodging">Lodging</a></li>
                            <li><a class="dropdown-item" href="#" data-value="manufacturing">Manufacturing & Industrial</a></li>
                            <li><a class="dropdown-item" href="#" data-value="mixed_use">Mixed Use</a></li>
                            <li><a class="dropdown-item" href="#" data-value="office">Office</a></li>
                            <li><a class="dropdown-item" href="#" data-value="oil_gas">Oil & Natural Gas</a></li>
                            <li><a class="dropdown-item" href="#" data-value="parking">Parking</a></li>
                            <li><a class="dropdown-item" href="#" data-value="public_services">Public Services</a></li>
                            <li><a class="dropdown-item" href="#" data-value="religious">Religious Worship</a></li>
                            <li><a class="dropdown-item" href="#" data-value="retail">Retail/Merchantile</a></li>
                            <li><a class="dropdown-item" href="#" data-value="services">Services</a></li>
                            <li><a class="dropdown-item" href="#" data-value="tech_science">Technology & Science</a></li>
                            <li><a class="dropdown-item" href="#" data-value="utility">Utility</a></li>
                            <li><a class="dropdown-item" href="#" data-value="vacant">Vacant</a></li>
                            <li><a class="dropdown-item" href="#" data-value="warehouse">Warehouse & Storage</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Sub-category questions --}}
            <div id="sub-category-section" class="mt-3" style="display: none;">
                <!-- Banking & Financial Services -->
                <div id="banking-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Banking & Financial Services location is this? *</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="banking_branch" value="banking_branch" {{ old('sub_category') == 'banking_branch' ? 'checked' : '' }}>
                            <label class="form-check-label" for="banking_branch">
                                Bank Branch
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="banking_financial_office" value="banking_financial_office" {{ old('sub_category') == 'banking_financial_office' ? 'checked' : '' }}>
                            <label class="form-check-label" for="banking_financial_office">
                                Financial Office
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Education -->
                <div id="education-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Education location is this? *</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_adult" value="education_adult" {{ old('sub_category') == 'education_adult' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_adult">
                                Adult Education
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_college" value="education_college" {{ old('sub_category') == 'education_college' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_college">
                                College & University
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_k12" value="education_k12" {{ old('sub_category') == 'education_k12' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_k12">
                                K-12 School
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_other" value="education_other" {{ old('sub_category') == 'education_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_other">
                                Other: Education
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_preschool" value="education_preschool" {{ old('sub_category') == 'education_preschool' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_preschool">
                                Pre-school & Daycare
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="education_vocational" value="education_vocational" {{ old('sub_category') == 'education_vocational' ? 'checked' : '' }}>
                            <label class="form-check-label" for="education_vocational">
                                Vocational School
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Entertainment & Public Assembly -->
                <div id="entertainment-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Entertainment & Public Assembly location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_center" value="entertainment_center" {{ old('sub_category') == 'entertainment_center' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_center">
                                Convenience center
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_movie" value="entertainment_movie" {{ old('sub_category') == 'entertainment_movie' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_movie">
                                Movie Theater
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_museum" value="entertainment_museum" {{ old('sub_category') == 'entertainment_museum' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_museum">
                                Museum
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_other" value="entertainment_other" {{ old('sub_category') == 'entertainment_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_other">
                                Other: Entertainment & Public Assembly
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_performing" value="entertainment_performing" {{ old('sub_category') == 'entertainment_performing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_performing">
                                Performing Arts
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_recreation" value="entertainment_recreation" {{ old('sub_category') == 'entertainment_recreation' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_recreation">
                                Recreation
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_social" value="entertainment_social" {{ old('sub_category') == 'entertainment_social' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_social">
                                Social & Meeting Hall: Entertainment & Public Assembly
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="entertainment_stadium" value="entertainment_stadium" {{ old('sub_category') == 'entertainment_stadium' ? 'checked' : '' }}>
                            <label class="form-check-label" for="entertainment_stadium">
                                Stadium
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Food Sales -->
                <div id="food_sales-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Food Sales location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_sales_convenience" value="food_sales_convenience" {{ old('sub_category') == 'food_sales_convenience' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_sales_convenience">
                                Convenience Store: Food Sales
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_sales_other" value="food_sales_other" {{ old('sub_category') == 'food_sales_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_sales_other">
                                Other: Food sales
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_sales_supermarket" value="food_sales_supermarket" {{ old('sub_category') == 'food_sales_supermarket' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_sales_supermarket">
                                Supermarket & Grocery Store: Food Sales
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_sales_wholesale" value="food_sales_wholesale" {{ old('sub_category') == 'food_sales_wholesale' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_sales_wholesale">
                                Wholesale Club & Supercenter: Food Sales
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Food Service -->
                <div id="food_service-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Food Service location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_service_bar" value="food_service_bar" {{ old('sub_category') == 'food_service_bar' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_service_bar">
                                Bar, pub, or lounge
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_service_fast" value="food_service_fast" {{ old('sub_category') == 'food_service_fast' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_service_fast">
                                Fast Food
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_service_other" value="food_service_other" {{ old('sub_category') == 'food_service_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_service_other">
                                Other: Food Service
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="food_service_restaurant" value="food_service_restaurant" {{ old('sub_category') == 'food_service_restaurant' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food_service_restaurant">
                                Restaurant & cafeteria
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Healthcare -->
                <div id="healthcare-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Healthcare location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_ambulatory" value="healthcare_ambulatory" {{ old('sub_category') == 'healthcare_ambulatory' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_ambulatory">
                                Ambulatory Surgical Center
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_hospital" value="healthcare_hospital" {{ old('sub_category') == 'healthcare_hospital' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_hospital">
                                Hospital
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_medical" value="healthcare_medical" {{ old('sub_category') == 'healthcare_medical' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_medical">
                                Medical Office: Healthcare
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_other" value="healthcare_other" {{ old('sub_category') == 'healthcare_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_other">
                                Other: Healthcare
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_rehab" value="healthcare_rehab" {{ old('sub_category') == 'healthcare_rehab' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_rehab">
                                Outpatient Rehabilitation & Physical Therapy
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_residential" value="healthcare_residential" {{ old('sub_category') == 'healthcare_residential' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_residential">
                                Residential Care Facility: Healthcare
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_senior" value="healthcare_senior" {{ old('sub_category') == 'healthcare_senior' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_senior">
                                Senior Care Community: Healthcare
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="healthcare_urgent" value="healthcare_urgent" {{ old('sub_category') == 'healthcare_urgent' ? 'checked' : '' }}>
                            <label class="form-check-label" for="healthcare_urgent">
                                Urgent Care & Clinic & Other Outpatient
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Lodging -->
                <div id="lodging-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Lodging location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_barracks" value="lodging_barracks" {{ old('sub_category') == 'lodging_barracks' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_barracks">
                                Barracks
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_hotel" value="lodging_hotel" {{ old('sub_category') == 'lodging_hotel' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_hotel">
                                Hotel
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_multifamily" value="lodging_multifamily" {{ old('sub_category') == 'lodging_multifamily' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_multifamily">
                                Multifamily Housing
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_other" value="lodging_other" {{ old('sub_category') == 'lodging_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_other">
                                Other: Lodging
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_prison" value="lodging_prison" {{ old('sub_category') == 'lodging_prison' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_prison">
                                Prison & Incarceration: Lodging
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_residence" value="lodging_residence" {{ old('sub_category') == 'lodging_residence' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_residence">
                                Residence Hall & Dormitory
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_residential" value="lodging_residential" {{ old('sub_category') == 'lodging_residential' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_residential">
                                Residential Care Facility: Lodging
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_senior" value="lodging_senior" {{ old('sub_category') == 'lodging_senior' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_senior">
                                Senior Care Community: Lodging
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="lodging_single" value="lodging_single" {{ old('sub_category') == 'lodging_single' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lodging_single">
                                Single Family Home
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Manufacturing & Industrial -->
                <div id="manufacturing-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Manufacturing & Industrial location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="manufacturing_plant" value="manufacturing_plant" {{ old('sub_category') == 'manufacturing_plant' ? 'checked' : '' }}>
                            <label class="form-check-label" for="manufacturing_plant">
                                Manufacturing & Industrial Plant
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Mixed Use -->
                <div id="mixed_use-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Mixed Use location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="mixed_use_property" value="mixed_use_property" {{ old('sub_category') == 'mixed_use_property' ? 'checked' : '' }}>
                            <label class="form-check-label" for="mixed_use_property">
                                Mixed Use Property
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Office -->
                <div id="office-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Office location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_administrative" value="office_administrative" {{ old('sub_category') == 'office_administrative' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_administrative">
                                Administrative or professional
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_government" value="office_government" {{ old('sub_category') == 'office_government' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_government">
                                Government
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_medical" value="office_medical" {{ old('sub_category') == 'office_medical' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_medical">
                                Medical Office: Office
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_mixed" value="office_mixed" {{ old('sub_category') == 'office_mixed' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_mixed">
                                Mixed-Use
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_general" value="office_general" {{ old('sub_category') == 'office_general' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_general">
                                Office
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="office_veterinary" value="office_veterinary" {{ old('sub_category') == 'office_veterinary' ? 'checked' : '' }}>
                            <label class="form-check-label" for="office_veterinary">
                                Veterinary Office
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Oil & Natural Gas -->
                <div id="oil_gas-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Oil & Natural Gas location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="oil_gas_compressor" value="oil_gas_compressor" {{ old('sub_category') == 'oil_gas_compressor' ? 'checked' : '' }}>
                            <label class="form-check-label" for="oil_gas_compressor">
                                Compressor Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="oil_gas_electricity" value="oil_gas_electricity" {{ old('sub_category') == 'oil_gas_electricity' ? 'checked' : '' }}>
                            <label class="form-check-label" for="oil_gas_electricity">
                                Electricity Generation Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="oil_gas_processing" value="oil_gas_processing" {{ old('sub_category') == 'oil_gas_processing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="oil_gas_processing">
                                Processing Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="oil_gas_water" value="oil_gas_water" {{ old('sub_category') == 'oil_gas_water' ? 'checked' : '' }}>
                            <label class="form-check-label" for="oil_gas_water">
                                Water Disposal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="oil_gas_well" value="oil_gas_well" {{ old('sub_category') == 'oil_gas_well' ? 'checked' : '' }}>
                            <label class="form-check-label" for="oil_gas_well">
                                Well Pad
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Parking -->
                <div id="parking-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Parking location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="parking_general" value="parking_general" {{ old('sub_category') == 'parking_general' ? 'checked' : '' }}>
                            <label class="form-check-label" for="parking_general">
                                Parking
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Public Services -->
                <div id="public_services-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Public Services location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_courthouse" value="public_services_courthouse" {{ old('sub_category') == 'public_services_courthouse' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_courthouse">
                                Courthouse
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_drinking_water" value="public_services_drinking_water" {{ old('sub_category') == 'public_services_drinking_water' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_drinking_water">
                                Drinking Water Treatment & Distribution: Public Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_fire" value="public_services_fire" {{ old('sub_category') == 'public_services_fire' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_fire">
                                Fire Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_library" value="public_services_library" {{ old('sub_category') == 'public_services_library' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_library">
                                Library
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_mailing" value="public_services_mailing" {{ old('sub_category') == 'public_services_mailing' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_mailing">
                                Mailing Center & Post Office
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_other" value="public_services_other" {{ old('sub_category') == 'public_services_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_other">
                                Other: Public Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_police" value="public_services_police" {{ old('sub_category') == 'public_services_police' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_police">
                                Police station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_prison" value="public_services_prison" {{ old('sub_category') == 'public_services_prison' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_prison">
                                Prison & Incarceration: Public Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_social" value="public_services_social" {{ old('sub_category') == 'public_services_social' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_social">
                                Social & Meeting Hall: Public Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_transportation" value="public_services_transportation" {{ old('sub_category') == 'public_services_transportation' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_transportation">
                                Transportation Terminal & Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="public_services_wastewater" value="public_services_wastewater" {{ old('sub_category') == 'public_services_wastewater' ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_services_wastewater">
                                Wastewater Treatment Plant: Public Services
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Religious Worship -->
                <div id="religious-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Religious Worship location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="religious_worship" value="religious_worship" {{ old('sub_category') == 'religious_worship' ? 'checked' : '' }}>
                            <label class="form-check-label" for="religious_worship">
                                Worship Facility
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Retail/Merchantile -->
                <div id="retail-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Retail/Mercantile location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_automobile" value="retail_automobile" {{ old('sub_category') == 'retail_automobile' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_automobile">
                                Automobile Dealership
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_convenience" value="retail_convenience" {{ old('sub_category') == 'retail_convenience' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_convenience">
                                Convenience Store: Retail/Mercantile
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_mall" value="retail_mall" {{ old('sub_category') == 'retail_mall' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_mall">
                                Mall
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_other" value="retail_other" {{ old('sub_category') == 'retail_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_other">
                                Other retail
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_other_mall" value="retail_other_mall" {{ old('sub_category') == 'retail_other_mall' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_other_mall">
                                Retail (other than mall)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_store" value="retail_store" {{ old('sub_category') == 'retail_store' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_store">
                                Retail Store
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_supermarket" value="retail_supermarket" {{ old('sub_category') == 'retail_supermarket' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_supermarket">
                                Supermarket & Grocery Store: Retail/Mercantile
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="retail_wholesale" value="retail_wholesale" {{ old('sub_category') == 'retail_wholesale' ? 'checked' : '' }}>
                            <label class="form-check-label" for="retail_wholesale">
                                Wholesale Club & Supercenter: Retail/Mercantile
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Services -->
                <div id="services-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Services location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="services_data_center" value="services_data_center" {{ old('sub_category') == 'services_data_center' ? 'checked' : '' }}>
                            <label class="form-check-label" for="services_data_center">
                                Data Center: Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="services_other" value="services_other" {{ old('sub_category') == 'services_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="services_other">
                                Other: Services
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="services_personal" value="services_personal" {{ old('sub_category') == 'services_personal' ? 'checked' : '' }}>
                            <label class="form-check-label" for="services_personal">
                                Personal Services (Health & Beauty, Dry Cleaning, etc.)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="services_repair" value="services_repair" {{ old('sub_category') == 'services_repair' ? 'checked' : '' }}>
                            <label class="form-check-label" for="services_repair">
                                Repair Services (Vehicle, Shoe, Locksmith, etc.)
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Technology & Science -->
                <div id="tech_science-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Technology & Science location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="tech_science_data_center" value="tech_science_data_center" {{ old('sub_category') == 'tech_science_data_center' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tech_science_data_center">
                                Data Center: Technology & Science
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="tech_science_laboratory" value="tech_science_laboratory" {{ old('sub_category') == 'tech_science_laboratory' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tech_science_laboratory">
                                Laboratory
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="tech_science_other" value="tech_science_other" {{ old('sub_category') == 'tech_science_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tech_science_other">
                                Other: Technology & Science
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Utility -->
                <div id="utility-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Utility location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="utility_drinking_water" value="utility_drinking_water" {{ old('sub_category') == 'utility_drinking_water' ? 'checked' : '' }}>
                            <label class="form-check-label" for="utility_drinking_water">
                                Drinking Water Treatment & Distribution: Utility
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="utility_energy" value="utility_energy" {{ old('sub_category') == 'utility_energy' ? 'checked' : '' }}>
                            <label class="form-check-label" for="utility_energy">
                                Energy & Power Station
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="utility_other" value="utility_other" {{ old('sub_category') == 'utility_other' ? 'checked' : '' }}>
                            <label class="form-check-label" for="utility_other">
                                Other: Utility
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="utility_wastewater" value="utility_wastewater" {{ old('sub_category') == 'utility_wastewater' ? 'checked' : '' }}>
                            <label class="form-check-label" for="utility_wastewater">
                                Wastewater Treatment Plant: Utility
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Vacant -->
                <div id="vacant-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Vacant location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="vacant_general" value="vacant_general" {{ old('sub_category') == 'vacant_general' ? 'checked' : '' }}>
                            <label class="form-check-label" for="vacant_general">
                                Vacant
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Warehouse & Storage -->
                <div id="warehouse-sub" class="sub-category" style="display: none;">
                    <label class="form-label">What kind of Warehouse & Storage location is this?</label>
                    <div class="radio-group">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="warehouse_distribution" value="warehouse_distribution" {{ old('sub_category') == 'warehouse_distribution' ? 'checked' : '' }}>
                            <label class="form-check-label" for="warehouse_distribution">
                                Distribution or Shipping Center
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="warehouse_nonrefrigerated" value="warehouse_nonrefrigerated" {{ old('sub_category') == 'warehouse_nonrefrigerated' ? 'checked' : '' }}>
                            <label class="form-check-label" for="warehouse_nonrefrigerated">
                                Nonrefrigerated
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="warehouse_refrigerated" value="warehouse_refrigerated" {{ old('sub_category') == 'warehouse_refrigerated' ? 'checked' : '' }}>
                            <label class="form-check-label" for="warehouse_refrigerated">
                                Refrigerated
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="warehouse_self_storage" value="warehouse_self_storage" {{ old('sub_category') == 'warehouse_self_storage' ? 'checked' : '' }}>
                            <label class="form-check-label" for="warehouse_self_storage">
                                Self-Storage Facility
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sub_category" id="warehouse_general" value="warehouse_general" {{ old('sub_category') == 'warehouse_general' ? 'checked' : '' }}>
                            <label class="form-check-label" for="warehouse_general">
                                Warehouse
                            </label>
                        </div>
                    </div>
                </div>
            </div>

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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Malaysian locations database
    const malaysianLocations = {
        // Kuala Lumpur
        'kuala lumpur': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '50000', lat: 3.1390, lng: 101.6869 },
        'kl': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '50000', lat: 3.1390, lng: 101.6869 },
        'bangsar': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '59200', lat: 3.1304, lng: 101.6676 },
        'bangsar south': { state: 'Kuala Lumpur', country: 'Malaysia', postal: '59200', lat: 3.1304, lng: 101.6676 },
        'bangi': { state: 'Selangor', country: 'Malaysia', postal: '43000', lat: 2.9140, lng: 101.7849 },
        'petaling jaya': { state: 'Selangor', country: 'Malaysia', postal: '46000', lat: 3.1073, lng: 101.6085 },
        'pj': { state: 'Selangor', country: 'Malaysia', postal: '46000', lat: 3.1073, lng: 101.6085 },
        'shah alam': { state: 'Selangor', country: 'Malaysia', postal: '40000', lat: 3.0733, lng: 101.5185 },
        'subang jaya': { state: 'Selangor', country: 'Malaysia', postal: '47500', lat: 3.0498, lng: 101.5854 },
        'klang': { state: 'Selangor', country: 'Malaysia', postal: '41000', lat: 3.0333, lng: 101.4500 },
        'kota kemuning': { state: 'Selangor', country: 'Malaysia', postal: '42500', lat: 3.0000, lng: 101.5000 },

        // Penang
        'penang': { state: 'Penang', country: 'Malaysia', postal: '10000', lat: 5.4164, lng: 100.3327 },
        'georgetown': { state: 'Penang', country: 'Malaysia', postal: '10200', lat: 5.4141, lng: 100.3288 },
        'butterworth': { state: 'Penang', country: 'Malaysia', postal: '12000', lat: 5.3994, lng: 100.3639 },
        'bayan lepas': { state: 'Penang', country: 'Malaysia', postal: '11900', lat: 5.2959, lng: 100.2773 },

        // Johor
        'johor bahru': { state: 'Johor', country: 'Malaysia', postal: '80000', lat: 1.4927, lng: 103.7414 },
        'jb': { state: 'Johor', country: 'Malaysia', postal: '80000', lat: 1.4927, lng: 103.7414 },
        'iskandar puteri': { state: 'Johor', country: 'Malaysia', postal: '79100', lat: 1.4244, lng: 103.6498 },
        'kulai': { state: 'Johor', country: 'Malaysia', postal: '81000', lat: 1.6561, lng: 103.6032 },

        // Sabah
        'kota kinabalu': { state: 'Sabah', country: 'Malaysia', postal: '88000', lat: 6.0319, lng: 116.1181 },
        'kk': { state: 'Sabah', country: 'Malaysia', postal: '88000', lat: 6.0319, lng: 116.1181 },
        'sandakan': { state: 'Sabah', country: 'Malaysia', postal: '90000', lat: 5.8402, lng: 118.1179 },
        'tawau': { state: 'Sabah', country: 'Malaysia', postal: '91000', lat: 4.2448, lng: 117.8912 },

        // Sarawak
        'kuching': { state: 'Sarawak', country: 'Malaysia', postal: '93000', lat: 1.5533, lng: 110.3592 },
        'miri': { state: 'Sarawak', country: 'Malaysia', postal: '98000', lat: 4.4025, lng: 113.9911 },
        'sibu': { state: 'Sarawak', country: 'Malaysia', postal: '96000', lat: 2.2875, lng: 111.8303 },

        // Perak
        'ipoh': { state: 'Perak', country: 'Malaysia', postal: '30000', lat: 4.5841, lng: 101.0829 },
        'taiping': { state: 'Perak', country: 'Malaysia', postal: '34000', lat: 4.8495, lng: 100.7400 },

        // Kedah
        'alor setar': { state: 'Kedah', country: 'Malaysia', postal: '05000', lat: 6.1248, lng: 100.3678 },
        'sungai petani': { state: 'Kedah', country: 'Malaysia', postal: '08000', lat: 5.6470, lng: 100.4873 },

        // Kelantan
        'kota bharu': { state: 'Kelantan', country: 'Malaysia', postal: '15000', lat: 6.1256, lng: 102.2436 },

        // Terengganu
        'kuala terengganu': { state: 'Terengganu', country: 'Malaysia', postal: '20000', lat: 5.3302, lng: 103.1408 },

        // Negeri Sembilan
        'seremban': { state: 'Negeri Sembilan', country: 'Malaysia', postal: '70000', lat: 2.7297, lng: 101.9381 },

        // Melaka
        'melaka': { state: 'Melaka', country: 'Malaysia', postal: '75000', lat: 2.1896, lng: 102.2501 },
        'malacca': { state: 'Melaka', country: 'Malaysia', postal: '75000', lat: 2.1896, lng: 102.2501 },

        // Pahang
        'kuantan': { state: 'Pahang', country: 'Malaysia', postal: '25000', lat: 3.8077, lng: 103.3260 },

        // Perlis
        'kangar': { state: 'Perlis', country: 'Malaysia', postal: '01000', lat: 6.4414, lng: 100.1986 }
    };

    const cityInput = document.getElementById('city');
    const countryInput = document.getElementById('country');
    const stateInput = document.getElementById('state');
    const postalCodeInput = document.getElementById('postal_code');
    const suggestionsContainer = document.getElementById('city-suggestions');
    let justSelected = false;

    // Function to get suggestions based on input
    function getSuggestions(input) {
        const inputLower = input.toLowerCase().trim();
        if (inputLower.length < 1) return [];

        const suggestions = [];
        const seen = new Set();

        for (const [city, data] of Object.entries(malaysianLocations)) {
            if (city.includes(inputLower)) {
                const key = `${city}|${data.state}|${data.country}`;
                if (!seen.has(key)) {
                    suggestions.push({ city, ...data });
                    seen.add(key);
                }
            }
        }

        return suggestions.slice(0, 8); // Limit to 8 suggestions
    }

    // Function to display suggestions
    function displaySuggestions(suggestions) {
        if (suggestions.length === 0) {
            suggestionsContainer.style.display = 'none';
            return;
        }

        suggestionsContainer.innerHTML = suggestions.map(suggestion => `
            <div class="suggestion-item" data-city="${suggestion.city}" data-state="${suggestion.state}" data-country="${suggestion.country}" data-postal="${suggestion.postal}">
                <div class="city-name">${suggestion.city}</div>
            </div>
        `).join('');

        suggestionsContainer.style.display = 'block';
        suggestionsContainer.classList.add('show');
    }

    // Handle input events
    cityInput.addEventListener('input', function(e) {
        if (justSelected) {
            justSelected = false;
            return;
        }

        const input = e.target.value;
        const suggestions = getSuggestions(input);
        displaySuggestions(suggestions);
    });

    // Handle suggestion clicks
    suggestionsContainer.addEventListener('click', function(e) {
        const suggestionItem = e.target.closest('.suggestion-item');
        if (suggestionItem) {
            const city = suggestionItem.dataset.city;
            const state = suggestionItem.dataset.state;
            const country = suggestionItem.dataset.country;
            const postal = suggestionItem.dataset.postal;

            cityInput.value = city;
            countryInput.value = country;
            stateInput.value = state;
            postalCodeInput.value = postal;

            justSelected = true;
            suggestionsContainer.style.display = 'none';
            suggestionsContainer.classList.remove('show');
        }
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!cityInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
            suggestionsContainer.style.display = 'none';
            suggestionsContainer.classList.remove('show');
        }
    });

    // Hide suggestions on blur
    cityInput.addEventListener('blur', function() {
        setTimeout(() => {
            suggestionsContainer.style.display = 'none';
            suggestionsContainer.classList.remove('show');
        }, 200);
    });

    const toggleBtn = document.getElementById("toggle-btn");
    const guidanceText = document.getElementById("guidance-text");
    toggleBtn.addEventListener("click", () => {
        if (guidanceText.style.display === "none" || guidanceText.style.display === "") {
            guidanceText.style.display = "block";
            toggleBtn.textContent = "Hide address guidance";
        } else {
            guidanceText.style.display = "none";
            toggleBtn.textContent = "I can't find my exact address";
        }
    });

    // Custom dropdowns setup
    setupCustomDropdowns();
});

// Function to show/hide sub-categories based on primary use selection
function showSubCategory() {
    const primarySelect = document.getElementById('primary');
    const subCategorySection = document.getElementById('sub-category-section');
    const selectedValue = primarySelect.value;

    // Hide all sub-categories first
    const subCategories = document.querySelectorAll('.sub-category');
    subCategories.forEach(sub => {
        sub.style.display = 'none';
    });

    // Show sub-category section and specific sub-category only if a valid option is selected
    if (selectedValue && ['banking', 'education', 'entertainment', 'food_sales', 'food_service', 'healthcare', 'lodging', 'manufacturing', 'mixed_use', 'office', 'oil_gas', 'parking', 'public_services', 'religious', 'retail', 'services', 'tech_science', 'utility', 'vacant', 'warehouse'].includes(selectedValue)) {
        subCategorySection.style.display = 'block';
        document.getElementById(selectedValue + '-sub').style.display = 'block';
    } else {
        subCategorySection.style.display = 'none';
    }
}

// Initialize sub-category display on page load
document.addEventListener('DOMContentLoaded', function() {
    showSubCategory();
});

// Custom dropdown utilities (shared style/behavior)
function setupCustomDropdowns() {
    // Toggle handlers
    document.querySelectorAll('.custom-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const dropdown = this.closest('.custom-dropdown');
            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            const isOpen = dropdownMenu.classList.contains('show');

            // Close all
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(t) {
                t.setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                dropdownMenu.classList.add('show');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Item selection handlers
    document.querySelectorAll('.custom-dropdown .dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const dropdown = this.closest('.custom-dropdown');
            const toggle = dropdown.querySelector('.custom-dropdown-toggle');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            const dropdownText = toggle.querySelector('.dropdown-text');

            const locationName = this.querySelector('.location-name');
            const displayText = locationName ? locationName.textContent : this.textContent;

            dropdownText.textContent = displayText;
            hiddenInput.value = this.dataset.value;

            // If primary changed, update sub-category visibility
            if (hiddenInput && hiddenInput.id === 'primary') {
                showSubCategory();
            }

            const dropdownMenu = dropdown.querySelector('.dropdown-menu');
            dropdownMenu.classList.remove('show');
            toggle.setAttribute('aria-expanded', 'false');
        });
    });

    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.custom-dropdown')) {
            document.querySelectorAll('.custom-dropdown .dropdown-menu').forEach(function(menu) {
                menu.classList.remove('show');
            });
            document.querySelectorAll('.custom-dropdown-toggle').forEach(function(t) {
                t.setAttribute('aria-expanded', 'false');
            });
        }
    });
}
</script>
@endsection
