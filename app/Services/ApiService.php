<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiService
{
    private Client $client;
    private string $key = 'E6kUTYrYwZq2tN4QEtyzsbEBk3ie';

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://109.73.206.144:6969/api/']);

    }

    public function getSales($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        return json_decode($this->client->get('sales', [
            'query' => compact('dateFrom', 'dateTo', 'page', 'limit')+ ['key' => $this->key]
        ])->getBody(), true);
    }

    public function getOrders($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        return json_decode($this->client->get('orders', [
            'query' => compact('dateFrom', 'dateTo', 'page', 'limit')+ ['key' => $this->key]
        ])->getBody(), true);
    }

    public function getStocks($dateFrom, $page = 1, $limit = 500)
    {
        return json_decode($this->client->get('stocks', [
            'query' => compact('dateFrom', 'page', 'limit')+ ['key' => $this->key]
        ])->getBody(), true);
    }

    public function getIncomes($dateFrom, $dateTo, $page = 1, $limit = 500)
    {
        return json_decode($this->client->get('incomes', [
            'query' => compact('dateFrom', 'dateTo', 'page', 'limit')+ ['key' => $this->key]
        ])->getBody(), true);
    }

}