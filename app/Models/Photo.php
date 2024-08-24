<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photos';

    protected $fillable = [
        'product_id',
        'href',
        'is_main',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
