<?php

namespace App\Models;

use App\Models\Relations\AssetRelation;
use Illuminate\Database\Eloquent\Model;

class Etf extends Asset
{
    use AssetRelation;

    protected $fillable = [
        'asset_id',
        'service_company',
        'commission',
        'follow_index',
        'birth_country_id',
    ];

}
