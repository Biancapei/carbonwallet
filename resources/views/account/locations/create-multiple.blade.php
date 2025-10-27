@extends('account.layout')

@section('title', 'Add Multiple Locations')

@section('content')
<div class="content-body">
    <div class="mb-4">
        <div class="alert alert-info">
            <i class="fas fa-list"></i> <strong>Multiple Locations Mode</strong> - Add multiple locations at once using the table below.
        </div>
    </div>

    <div id="multiple-locations-form">
        <div class="text-center">
            <div class="admin-header">Add Multiple Locations</div>
            <p>Upload multiple locations at once. You can always download the locations data below to share with others or come back to this screen to re-upload your data at a later point in time.</p>
            <p><a href="#" class="text-primary">Learn more about how to add multiple locations</a></p>
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
</div>
@endsection
