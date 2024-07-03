<?php

namespace Modules\Shop\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shop\Database\Factories\TagFactory;


use App\Traits\UuidTrait;
class Tag extends Model
{
    use HasFactory, UuidTrait;

    /**
     * The attributes that are mass assignable.
     */

    protected $table = 'shop_tags';
    protected $fillable = [
        'slug',
        'name',
    ];

    protected static function newFactory()
    {
        return TagFactory::new();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'shop_categories_products', 'product_id', 'category_id');
    }
}

