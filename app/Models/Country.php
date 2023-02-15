<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'code',
        'name'
    ];

    public $translatable = ['name'];

    public function covidData(): HasMany
    {
        return $this->hasMany(CovidData::class,'country_id');
    }
}
