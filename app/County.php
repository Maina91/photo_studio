<?php

namespace App;

use App\Town;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class County extends Model
{
    use HasFactory;

    protected $table = 'counties';

    protected $fillable = [
        'county_name',
        'country_id',
        'added_by',
        'added_on',
    ];

    /**
     * Relationship: A county belongs to a country.
     */

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Relationship: A county has many towns.
     */
    public function towns()
    {
        return $this->hasMany(Town::class);
    }
}
