<?php

namespace App\Http\Controllers\Web;

use App\Repositories\CurrencyRepository;

class HomeController extends Controller
{
    /**
     * @var CurrencyRepository
     */
    protected $currencyRepository;

    /**
     * @param CurrencyRepository $currencyRepository
     *
     * @return void
     */
    public function __construct(CurrencyRepository $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $soldCurrencies = $this->currencyRepository->getAllSoldCurrencies();
        $boughtCurrencies = $this->currencyRepository->getAllBoughtCurrencies();

        return view('master', [
            'soldCurrencies' => $soldCurrencies,
            'boughtCurrencies' => $boughtCurrencies
        ]);
    }
}
