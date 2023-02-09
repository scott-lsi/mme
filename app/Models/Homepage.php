<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['testimonials', 'salesperson'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class);
    }

    public function salesperson()
    {
        return $this->belongsTo(Salesperson::class);
    }
}

