<?php

namespace App\Console\Commands;

use App\Repositories\CountryRepositoryInterface;
use App\Repositories\CovidStatisticRepositoryInterface;
use Illuminate\Console\Command;

class FetchCovidData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:covid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data about covid deaths';
    private CountryRepositoryInterface $countryRepository;
    private CovidStatisticRepositoryInterface $covidStatisticRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CountryRepositoryInterface $countryRepository, CovidStatisticRepositoryInterface $covidStatisticRepository )
    {
        parent::__construct();

        $this->countryRepository = $countryRepository;
        $this->covidStatisticRepository = $covidStatisticRepository ;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->countryRepository->fetchData();
        $this->covidStatisticRepository->fetchData();
    }
}
