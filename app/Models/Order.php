<?php

namespace CodeDelivery\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'client_id',
        'user_deliveryman_id',
        'total',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deliveryman()
    {
        return $this->belongsTo(User::class, 'user_deliveryman_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function getFormattedTotalAttribute()
    {
        return $this->attributes['total'] = number_format($this->attributes['total'], 2, ',', '.');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y \à\s H:i\h');
    }
    
    public function setUserDeliverymanIdAttribute($value)
    {
        $this->attributes['user_deliveryman_id'] = $value ?: null;
    }
}
