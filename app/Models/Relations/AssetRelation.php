<?php


namespace App\Models\Relations;


use App\Models\Asset;

trait AssetRelation
{
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
