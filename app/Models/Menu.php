<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id',
        'name',
        'description',
        'price',
    ];
        public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

        public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
