<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;

    use SoftDeletes;

    const STATUS_PUBLISH = 'publish';
    const STATUS_DRAFT = 'draft';

    protected $fillable = [
        'name',
        'cover',
        'status',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
