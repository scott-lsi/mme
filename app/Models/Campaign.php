<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $with = ['homepages'];

    public function homepages()
    {
        return $this->hasMany(Homepage::class);
    }

    // delete homepages when deleting this model
    public static function boot() {
        parent::boot();
        self::deleting(function($campaign) { // before delete() method call this
            $campaign->homepages()->each(function($homepage) {
                $homepage->delete();
            });
        });
    }
}
