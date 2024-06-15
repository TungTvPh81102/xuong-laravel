<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Catalogue extends Model
{
    use HasFactory;

    use SoftDeletes;

    const STATUS_PUBLISH = 'publish';
    const STATUS_DRAFT = 'draft';

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'status'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->slug = Str::slug($model->name, '-');
        });
    }

    // Quan hệ 1 nhiều 1 catalogue -> nhiều products
    public function products() {
        return $this->hasMany(Product::class);
    }
}
