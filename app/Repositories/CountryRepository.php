<?php

namespace App\Repositories;

use App\Models\Country;
use App\Repositories\Base\BaseRepository;

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
                $filteredData = [
                    'name' => $country['name'],
                    'code' => $country['code']
                ];
                $this->createOrUpdate('code', $filteredData);
            }
        }
    }
}
