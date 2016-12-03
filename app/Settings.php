<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calories_per_day'
    ];

    /**
     * Get the user that owns the settings
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
