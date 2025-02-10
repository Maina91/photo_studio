<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'lead_name',
        'job_type',
        'scheduled_at',
        'notes',
        'status',
        'estimated_budget',
        'source',
        'signed_contract'
    ];



    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
