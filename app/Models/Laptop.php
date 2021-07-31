<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'description',
        'price'

    ];

    public function container() {
        return $this->belongsTo('App\Models\Laptop', 'contained_in', 'id');
    }
}
