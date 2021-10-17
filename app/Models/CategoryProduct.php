<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryProduct extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name', 'description'
    ];

    static public function boot()
    {
        parent::boot();
        self::creating(function($query) {
            $query->id = Str::uuid();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
