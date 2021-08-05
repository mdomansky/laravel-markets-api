<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Price extends Model
{
    protected $collection = 'prices';

    protected $connection = 'mongodb';

    protected $dates = ['date'];

    protected $fillable = [
        'asset_id',
        'price',
        'date',
    ];

    public $timestamps = false;
}
