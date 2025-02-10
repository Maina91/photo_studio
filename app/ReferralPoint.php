<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferralPoint  extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = ['client_id', 'points'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
