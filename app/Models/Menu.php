<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'image', 'price', 'status'];

    /**
     * Get all of the orderDetails for the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}
