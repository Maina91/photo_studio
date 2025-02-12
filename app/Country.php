<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'short_name',
        'name',
        'phone_code',
    ];

    /**
     * Relationship: A country has many counties.
     */
    public function counties()
    {
        return $this->hasMany(County::class);
    }
}
