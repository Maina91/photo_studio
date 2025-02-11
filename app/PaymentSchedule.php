<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSchedule  extends Model
{
    use  HasFactory;

    protected $fillable = [
        'name',
        'initial_payment_percentage',
        'remaining_payment_days',
    ];
}
