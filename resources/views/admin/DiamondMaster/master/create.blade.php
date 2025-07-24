@extends('admin.layouts.master')
@section('main_section')
<div class="container py-4">
    <h4>Add New Diamond</h4>
    <form id="createForm" action="{{ route('diamond-master.store') }}" method="POST">
        @csrf

        @php
            $generalFields = [
                ['diamond_type', 'Type', 'select', [1 => 'Natural', 2 => 'Lab']],
                ['quantity', 'Quantity', 'number'],
                ['vendor_id', 'Vendor', 'select', $vendors],
                ['vendor_stock_number', 'Vendor Stock #', 'text'],
                ['stock_number', 'Stock #', 'text'],
                ['carat_weight', 'Carat Weight', 'number'],
                ['is_superdeal', 'Is Superdeal', 'select', [0 => 'No', 1 => 'Yes']],
                ['availability', 'Availability', 'select', [0 => 'Hold', 1 => 'Available', 2 => 'Memo']],
                ['status', 'Status', 'select', [1 => 'Active', 0 => 'Inactive']],
            ];

            $selectAttributeFields = [
                ['shape', 'Shape', $shapes],
                ['color', 'Color', $colors],
                ['clarity', 'Clarity', $clarities],
                ['cut', 'Cut', $cuts],
                ['culet', 'Culet', $culet],
                ['polish', 'Polish', $polish],
                ['symmetry', 'Symmetry', $symmetry],
                ['fluorescence', 'Fluorescence', $fluorescence],
                ['fancy_color_intensity', 'Fancy Color Intensity', $fancyColorIntensity],
                ['fancy_color_overtone', 'Fancy Color Overtones', $fancycolorOvertones],
            ];

            $priceFields = [
                ['price', 'Price', 'number'],
                ['msrp_price', 'MSRP Price', 'number'],
                ['price_per_carat', 'Price/Carat', 'number'],
                ['vendor_rap_disc', 'Vendor RAP Disc', 'number'],
                ['vendor_price', 'Vendor Price', 'number'],
            ];

            $measurementFields = [
                ['measurement_l', 'Measurement L', 'number'],
                ['measurement_h', 'Measurement H', 'number'],
                ['measurement_w', 'Measurement W', 'number'],
                ['depth', 'Depth', 'number'],
                ['table_diamond', 'Table Diamond', 'number'],
            ];

            $certFields = [
                ['certificate_company', 'Cert Company', 'select', $labs],
                ['certificate_number', 'Cert Number', 'text'],
                ['certificate_date', 'Cert Date', 'date'],
            ];

            $urlFields = [
                ['image_link', 'Image URL', 'text'],
                ['cert_link', 'Cert URL', 'text'],
                ['video_link', 'Video URL', 'text'],
            ];
        @endphp

        {{-- Section: General Information --}}
        <div class="card mb-4">
            <div class="card-header"><strong>General Information</strong></div>
            <div class="card-body row g-3">
                @foreach ($generalFields as $f)
                    @php list($name, $label, $type, $opts) = array_pad($f, 4, []) @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        @if ($type === 'select')
                            <select name="{{ $name }}" id="{{ $name }}" class="form-select">
                                <option value="">-- Select --</option>
                                @foreach ($opts as $k => $v)
                                    <option value="{{ $k }}" {{ old($name) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name) }}">
                        @endif
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section: Diamond Attributes --}}
        <div class="card mb-4">
            <div class="card-header"><strong>Diamond Attributes</strong></div>
            <div class="card-body row g-3">
                @foreach ($selectAttributeFields as $f)
                    @php list($name, $label, $opts) = $f @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        <select name="{{ $name }}" id="{{ $name }}" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach ($opts as $k => $v)
                                <option value="{{ $k }}" {{ old($name) == $k ? 'selected' : '' }}>{{ $v }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section: Pricing --}}
        <div class="card mb-4">
            <div class="card-header"><strong>Pricing Information</strong></div>
            <div class="card-body row g-3">
                @foreach ($priceFields as $f)
                    @php list($name, $label, $type) = $f @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name) }}">
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section: Measurements --}}
        <div class="card mb-4">
            <div class="card-header"><strong>Measurements</strong></div>
            <div class="card-body row g-3">
                @foreach ($measurementFields as $f)
                    @php list($name, $label, $type) = $f @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name) }}">
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section: Certificate --}}
        <div class="card mb-4">
            <div class="card-header"><strong>Certificate Information</strong></div>
            <div class="card-body row g-3">
                @foreach ($certFields as $f)
                    @php list($name, $label, $type, $opts) = array_pad($f, 4, []) @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        @if ($type === 'select')
                            <select name="{{ $name }}" id="{{ $name }}" class="form-select">
                                <option value="">-- Select --</option>
                                @foreach ($opts as $k => $v)
                                    <option value="{{ $k }}" {{ old($name) == $k ? 'selected' : '' }}>{{ $v }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name) }}">
                        @endif
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Section: URLs --}}
        <div class="card mb-4">
            <div class="card-header"><strong>Media & URLs</strong></div>
            <div class="card-body row g-3">
                @foreach ($urlFields as $f)
                    @php list($name, $label, $type) = $f @endphp
                    <div class="col-md-4">
                        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
                        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control" value="{{ old($name) }}">
                        <span class="text-danger" id="error_{{ $name }}"></span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('diamond-master.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

{{-- AJAX Script --}}
<script>
    $(function(){
        function clearErrors() {
            $('.text-danger').text('');
        }

        function showErrors(errors) {
            $.each(errors, function (field, msgs) {
                $('#error_' + field).text(msgs[0]);
            });
        }

        $('#createForm').submit(function(e){
            e.preventDefault();
            clearErrors();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(res) {
                    toastr.success(res.message);
                    window.location.href = '{{ route('diamond-master.index') }}';
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors);
                    } else {
                        alert('Something went wrong.');
                    }
                }
            });
        });
    });
</script>
@endsection
