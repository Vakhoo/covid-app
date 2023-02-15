<?php

namespace App\Http\Controllers;

use App\Repositories\CountryRepositoryInterface;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function index(Request $request)
    {
        return $this->countryRepository->getData( $request);
    }
}
