<?php

namespace App\Support;

use App\Models\Setting;
use Throwable;

class DeliveryFee
{
    public const DEFAULT_ORIGIN_LAT = 11.5564;
    public const DEFAULT_ORIGIN_LNG = 104.9282;
    public const DEFAULT_BASE_FEE = 1.50;
    public const DEFAULT_FEE_PER_KM = 0.35;

    public static function config(): array
    {
        return [
            'origin_lat' => self::settingNumber('delivery_origin_lat', self::DEFAULT_ORIGIN_LAT),
            'origin_lng' => self::settingNumber('delivery_origin_lng', self::DEFAULT_ORIGIN_LNG),
            'base_fee' => self::settingNumber('delivery_base_fee', self::DEFAULT_BASE_FEE),
            'fee_per_km' => self::settingNumber('delivery_fee_per_km', self::DEFAULT_FEE_PER_KM),
        ];
    }

    public static function calculate(?string $fulfillmentMethod, ?float $destinationLat, ?float $destinationLng): array
    {
        $method = (string) $fulfillmentMethod;
        if ($method !== 'delivery') {
            return [
                'distance_km' => 0.0,
                'fee' => 0.0,
            ];
        }

        if ($destinationLat === null || $destinationLng === null) {
            return [
                'distance_km' => 0.0,
                'fee' => 0.0,
            ];
        }

        $config = self::config();
        $distanceKm = self::distanceKm(
            (float) $config['origin_lat'],
            (float) $config['origin_lng'],
            $destinationLat,
            $destinationLng
        );

        $fee = (float) $config['base_fee'] + ($distanceKm * (float) $config['fee_per_km']);

        return [
            'distance_km' => round($distanceKm, 2),
            'fee' => round(max(0, $fee), 2),
        ];
    }

    public static function distanceKm(float $fromLat, float $fromLng, float $toLat, float $toLng): float
    {
        $earthRadiusKm = 6371;

        $fromLatRad = deg2rad($fromLat);
        $toLatRad = deg2rad($toLat);
        $deltaLat = deg2rad($toLat - $fromLat);
        $deltaLng = deg2rad($toLng - $fromLng);

        $a = sin($deltaLat / 2) ** 2
            + cos($fromLatRad) * cos($toLatRad) * sin($deltaLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadiusKm * $c;
    }

    private static function settingNumber(string $key, float $default): float
    {
        try {
            $raw = Setting::where('key', $key)->value('value');
            if ($raw === null || $raw === '') {
                return $default;
            }

            return is_numeric($raw) ? (float) $raw : $default;
        } catch (Throwable $e) {
            return $default;
        }
    }
}
