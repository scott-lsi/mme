<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesperson extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function homepages()
    {
        return $this->hasMany(Homepage::class);
    }
}
