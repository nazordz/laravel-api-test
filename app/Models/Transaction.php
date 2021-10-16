<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id', 'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction_products()
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
