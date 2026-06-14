<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings — Maps & Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/admin/dashboard">Admin</a>
        </div>
    </nav>
    <div class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">Google Maps & Delivery Settings</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <p class="text-muted">Set your map key, shop location, and delivery pricing. Checkout delivery fees are calculated from this location.</p>
                        <form method="POST" action="{{ route('admin.settings.maps.save') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="google_maps_api_key" class="form-label">API Key</label>
                                <input type="text" id="google_maps_api_key" name="google_maps_api_key" value="{{ old('google_maps_api_key', $current) }}" class="form-control" placeholder="AIza..." />
                                @error('google_maps_api_key')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <h6 class="mb-3">Shop Location (Origin)</h6>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="delivery_origin_lat" class="form-label">Latitude</label>
                                    <input
                                        type="number"
                                        step="0.0000001"
                                        id="delivery_origin_lat"
                                        name="delivery_origin_lat"
                                        value="{{ old('delivery_origin_lat', $deliveryConfig['origin_lat']) }}"
                                        class="form-control"
                                        placeholder="11.5564"
                                    />
                                    @error('delivery_origin_lat')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="delivery_origin_lng" class="form-label">Longitude</label>
                                    <input
                                        type="number"
                                        step="0.0000001"
                                        id="delivery_origin_lng"
                                        name="delivery_origin_lng"
                                        value="{{ old('delivery_origin_lng', $deliveryConfig['origin_lng']) }}"
                                        class="form-control"
                                        placeholder="104.9282"
                                    />
                                    @error('delivery_origin_lng')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mb-3">Delivery Pricing</h6>
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label for="delivery_base_fee" class="form-label">Base Fee (USD)</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="delivery_base_fee"
                                        name="delivery_base_fee"
                                        value="{{ old('delivery_base_fee', $deliveryConfig['base_fee']) }}"
                                        class="form-control"
                                        placeholder="1.50"
                                    />
                                    @error('delivery_base_fee')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="delivery_fee_per_km" class="form-label">Fee per KM (USD)</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        min="0"
                                        id="delivery_fee_per_km"
                                        name="delivery_fee_per_km"
                                        value="{{ old('delivery_fee_per_km', $deliveryConfig['fee_per_km']) }}"
                                        class="form-control"
                                        placeholder="0.35"
                                    />
                                    @error('delivery_fee_per_km')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="/admin/dashboard" class="btn btn-secondary">Back</a>
                        </form>
                        <hr>
                        <div class="small text-muted">
                            Tip: You can also set <code>GOOGLE_MAPS_API_KEY</code> in your <code>.env</code>. The app will prefer the Admin setting if present.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
