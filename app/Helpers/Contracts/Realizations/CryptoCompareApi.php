<?php

namespace App\Helpers\Contracts\Realizations;

use App\Helpers\Contracts\CurrenciesCourse;

class CryptoCompareApi implements CurrenciesCourse {

  public function get() {

    return json_decode(file_get_contents("https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,LTC,XRP&tsyms=UAH"));
  }
}