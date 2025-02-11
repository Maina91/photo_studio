<?php

namespace App;


use App\LeadSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function source()
    {
        return $this->belongsTo(LeadSource::class, 'lead_source_id');
    }
}
