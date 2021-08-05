<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Asset extends Model
{
    use HybridRelations;

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

    public function prices(Carbon $date = null)
    {
        if ($date) {
            return $this->hasMany(Price::class)->first(
                function ($item) use ($date) {
                    return $item->date == $date->endOfDay();
                }
            );
        }

        return $this->hasMany(Price::class);
    }

    public function getDetails()
    {
        return $this->{$this->getType()}();
    }

    public function getType(): ?string
    {
        if ($this->stock) {
            return 'stock';
        } elseif ($this->bond) {
            return 'bond';
        } elseif ($this->etf) {
            return 'etf';
        }

        return false;
    }

    protected function stock()
    {
        return $this->hasOne(Stock::class);
    }

    protected function bond()
    {
        return $this->hasOne(Bond::class);
    }

    protected function etf()
    {
        return $this->hasOne(Etf::class);
    }
}
