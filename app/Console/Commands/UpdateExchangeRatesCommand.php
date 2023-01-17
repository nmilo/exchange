<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ExchangeRateUpdaterService;

class UpdateExchangeRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:exchange-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates exchange rates';

     /**
     * @var ExchangeRateUpdaterService
     */
    protected $exchangeRateUpdaterService;

    /**
     * Create a new command instance.
     *
     * @param ExchangeRateUpdaterService $exchangeRateUpdaterService
     *
     */
    public function __construct(ExchangeRateUpdaterService $exchangeRateUpdaterService)
    {
        parent::__construct();
        $this->exchangeRateUpdaterService = $exchangeRateUpdaterService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $ratesUpdated = $this->exchangeRateUpdaterService->updateRates();

        if (!$ratesUpdated)
        {
            $this->error('Error occured while trying to update exchange rates');

            return 1;
        }

        $this->info('Exchange rates successfully updated.');

        return 0;
    }
}
