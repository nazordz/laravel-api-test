<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_product_id',
        'stock'
    ];

    public function category_product()
    {
        return $this->belongsTo(CategoryProduct::class);
    }

    public function transaction_products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
