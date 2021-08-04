<?php

namespace App\Models;

use App\Models\Relations\AssetRelation;
use Illuminate\Database\Eloquent\Model;

class Bond extends Asset
{
    use AssetRelation;

    protected $fillable = [
        'asset_id',
        'utility_at',
        'sum',
        'payments_per_year',
    ];

    protected $dates = [
        'utility_at',
    ];

}
