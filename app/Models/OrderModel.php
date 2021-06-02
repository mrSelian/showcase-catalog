<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer',
        'phone',
        'product_id',
    ];

    public static function withId(?int $id): Builder
    {
        return self::query()
            ->where('id', '=', $id);
    }
}
