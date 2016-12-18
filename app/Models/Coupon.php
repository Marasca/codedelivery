<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Coupon extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'code',
        'value',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFormattedValueAttribute()
    {
        return $this->attributes['value'] = number_format($this->attributes['value'], 2, ',', '.');
    }
}
