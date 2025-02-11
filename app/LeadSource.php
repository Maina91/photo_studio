<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadSource  extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
