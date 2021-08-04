<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'ticker',
        'name',
        'long_name',
        'description',
        'currency_id',
        'isin',
        'listing_start_date_at',
        'listing_end_date_at',
        'papers_in_lot',
    ];

    protected $dates = [
        'listing_start_date_at',
        'listing_end_date_at',
    ];

}
