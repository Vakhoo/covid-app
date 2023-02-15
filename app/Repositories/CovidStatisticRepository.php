<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\CovidData;
use App\Repositories\Base\BaseRepository;
use GuzzleHttp\Client;
use Carbon\Carbon;

class CovidStatisticRepository extends BaseRepository implements CovidStatisticRepositoryInterface
{
    public function __construct(CovidData $model)
    {
        parent::__construct($model);
    }

    public function fetchData()
    {
        $countries = Country::all();

        $client = new Client();
        foreach ($countries as $country) {
            $url = "https://devtest.ge/get-country-statistics/";
            $response = $client->post($url, [
                'form_params' => [
                    'code' => $country->code,
                ],
            ]);
            if ($response->getStatusCode() == 200) {
                $covidData = json_decode($response->getBody(), true);
                $filteredData = [
                    "country_id" => $country->id,
                    "confirmed" => $covidData['confirmed'],
                    "recovered" => $covidData['recovered'],
                    "critical" => $covidData['critical'],
                    "deaths" => $covidData['deaths']
                ];
                $this->createOrUpdate('country_id', $filteredData, $this->mustCreated($country->code));
            }
        }
    }

    public function summary()
    {
        $totalDeath = $this->model::sum('deaths');
        $totalConfirmed = $this->model::sum('confirmed');
        $totalRecovered = $this->model::sum('recovered');
        return response([
            'total_deaths' => $totalDeath,
            'total_confirmed' => $totalConfirmed,
            'total_recovered' => $totalRecovered,
        ], 200);
    }

    public function mustCreated($code)
    {
        $today = Carbon::now()->format('Y-m-d');

        $collection = Country::where('code', $code)->whereHas('covidData', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->get();


        if ($collection->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }


}
