<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CovidData extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'confirmed',
        'recovered',
        'critical',
        'deaths'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id')->select('id', 'code', 'name');
    }
}
