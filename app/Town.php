<?php

namespace App;

use App\County;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Town extends Model
{
    use HasFactory;

    protected $table = 'towns';

    protected $fillable = [
        'name',
        'country_id',
    ];

    /**
     * Relationship: A town belongs to a country.
     */
    public function county()
    {
        return $this->belongsTo(County::class);
    }
}
