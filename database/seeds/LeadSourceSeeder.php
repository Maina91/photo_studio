<?php

use App\User;
use App\LeadSource;
use Illuminate\Database\Seeder;

class LeadSourceSeeder extends Seeder
{
    public function run()
    {
        $sources = ['Website', 'Referral', 'Social Media', 'Advertisement'];

        foreach ($sources as $source) {
            LeadSource::updateOrCreate(['name' => $source]);
        }
    }
}
