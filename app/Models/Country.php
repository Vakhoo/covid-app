<?php

namespace App\Models;

use App\Models\Translations\CountryTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, Translatable;

    protected $fillable = [
        'code'
    ];

    protected $translationModel = CountryTranslation::class;

    public $translatedAttributes = ['name'];

    public function covidData(): HasMany
    {
        return $this->hasMany(CovidData::class,'country_id');
    }
}
