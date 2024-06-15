<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
    const STATUS_PUBLISH = 'publish';
    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'brand_id',
        'catalogue_id',
        'name',
        'slug',
        'sku',
        'image_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'marterial',
        'user_manval',
        'view',
        'status',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
        'is_show_home',
    ];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // Quan hệ nhiều nhiều
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
