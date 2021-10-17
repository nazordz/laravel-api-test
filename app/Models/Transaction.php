<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id', 'type'
    ];

    static public function boot()
    {
        parent::boot();
        self::creating(function($query) {
            $query->id = Str::uuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
