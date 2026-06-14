<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderStatusChange;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'fulfillment_method',
        'address_line',
        'city',
        'state',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'delivery_notes',
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PAID = 'paid';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_DELIVERED = 'delivered';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected array $allowedTransitions = [
        self::STATUS_PENDING => [self::STATUS_PAID, self::STATUS_CANCELLED],
        self::STATUS_PAID => [self::STATUS_PROCESSING, self::STATUS_CANCELLED],
        self::STATUS_PROCESSING => [self::STATUS_SHIPPED, self::STATUS_CANCELLED],
        self::STATUS_SHIPPED => [self::STATUS_DELIVERED],
        self::STATUS_DELIVERED => [self::STATUS_COMPLETED],
        self::STATUS_COMPLETED => [],
        self::STATUS_CANCELLED => [],
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusChanges()
    {
        return $this->hasMany(OrderStatusChange::class);
    }

    public function canTransitionTo(string $to): bool
    {
        $current = $this->status;
        return in_array($to, $this->allowedTransitions[$current] ?? [], true);
    }

    public function transitionTo(string $to, ?int $userId = null, array $meta = []): bool
    {
        $from = $this->status;
        if (!$this->canTransitionTo($to)) {
            return false;
        }

        $this->status = $to;
        $this->save();

        $this->statusChanges()->create([
            'from_status' => $from,
            'to_status' => $to,
            'user_id' => $userId ?? Auth::id(),
            'meta' => $meta,
        ]);

        return true;
    }
}
