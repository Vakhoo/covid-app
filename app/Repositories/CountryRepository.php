<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Base\BaseRepository;
use Illuminate\Support\Facades\App;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function fetchData()
    {
        $url = "https://devtest.ge/countries/";
        $response = file_get_contents($url);
        if ($response) {
            $countryData = json_decode($response, true);
            foreach ($countryData as $country) {
                $tranlateArray = [];

                foreach ($country['name'] as $locale => $name) {
                    $tranlateArray[$locale] = ['name' => $name];
                }
                $filteredData = [
                    'code' => $country['code']
                ];
                $filteredData = array_merge($filteredData, $tranlateArray);
                $this->createOrUpdate('code', $filteredData);
            }
        }
    }
}
