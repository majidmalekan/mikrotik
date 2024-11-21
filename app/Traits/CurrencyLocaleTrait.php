<?php

namespace App\Traits;

use Exception;
use Modules\GiftCard\Services\GiftCardProductBuyPriceService;
use Modules\Region\Services\CurrencyService;
use Modules\Order\Entities\ExchangeMoney;

trait CurrencyLocaleTrait
{
    /**
     * Convert price through locale
     * @param string $locale
     * @return float
     * @throws Exception
     */

    public function convertCurrency(): float|int
    {
        return ($this->price * ($this->currency?->exchange_money_active / $this->getCurrencyDueToLocale()->exchange_money_active));
    }
    public function getCurrencyDueToLocale()
    {
        $locale = request()->header('locale', request()->getLocale());
        $currencyService = app()->make(CurrencyService::class);
        return $currencyService->findCurrencyByLocale($locale);
    }
}
