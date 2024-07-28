<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyConverter
{
    private $apikey;

    protected $baseUrl = "https://free.currencyconverterapi.com/api/v7";

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;
    }

    public function convert(string $from , string $to , float $amount = 1) :float
    {
        $q = "{$from}_{$to}";
       $response =  Http::baseUrl($this->baseUrl)
            ->get('/convert',[
               'q' => $q,
               'compact' => 'y',
               'apiKey' => $this->apikey
            ]);

       $result = $response->json();

       dd($result);

       return $result[$q]['val'] * $amount;
    }

}
