<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Support\DeliveryFee;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function maps()
    {
        $current = Setting::where('key', 'google_maps_api_key')->value('value');
        $deliveryConfig = DeliveryFee::config();

        return view('admin.settings.google-maps', compact('current', 'deliveryConfig'));
    }

    public function saveMaps(Request $request)
    {
        $validated = $request->validate([
            'google_maps_api_key' => 'nullable|string|max:200',
            'delivery_origin_lat' => 'nullable|numeric|between:-90,90',
            'delivery_origin_lng' => 'nullable|numeric|between:-180,180',
            'delivery_base_fee' => 'nullable|numeric|min:0|max:10000',
            'delivery_fee_per_km' => 'nullable|numeric|min:0|max:10000',
        ]);

        Setting::updateOrCreate(
            ['key' => 'google_maps_api_key'],
            ['value' => $request->input('google_maps_api_key')]
        );

        $this->saveSettingValue('delivery_origin_lat', $validated['delivery_origin_lat'] ?? null);
        $this->saveSettingValue('delivery_origin_lng', $validated['delivery_origin_lng'] ?? null);
        $this->saveSettingValue('delivery_base_fee', $validated['delivery_base_fee'] ?? null);
        $this->saveSettingValue('delivery_fee_per_km', $validated['delivery_fee_per_km'] ?? null);

        // Optionally refresh config immediately
        config(['services.google_maps.key' => $request->input('google_maps_api_key')]);

        return redirect()->route('admin.settings.maps')->with('success', 'Settings updated successfully.');
    }

    private function saveSettingValue(string $key, $value): void
    {
        if ($value === null || $value === '') {
            Setting::where('key', $key)->delete();
            return;
        }

        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value]
        );
    }
}
