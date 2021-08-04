<?php

namespace App\Models;

use App\Models\Relations\AssetRelation;
use Illuminate\Database\Eloquent\Model;

class Stock extends Asset
{
    use AssetRelation;

    protected $fillable = [
        'asset_id',
        'type',
    ];

}
