<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'description',
        'price',
        'old_price',
        'amount',
        'brand',
        'photos',
        'liquid',
        'hard',
        'wet',
        'warm',
        'deleted'
    ];

    public static function withId(?int $id): Builder
    {
        return self::query()
            ->where('id', '=', $id);
    }
}
