<?php

namespace App\Http\Controllers;

use App\Repositories\CovidStatisticRepositoryInterface;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    protected $covidRepository;

    public function __construct(CovidStatisticRepositoryInterface $covidRepository)
    {
        $this->covidRepository = $covidRepository;
    }

    public function index(Request $request)
    {
        return $this->covidRepository->getData($request, ['country']);
    }

    public function summary()
    {
        return $this->covidRepository->summary();
    }
}
