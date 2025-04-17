<?php

namespace WisdomDiala\Cryptocap\API;

class Coincap
{
    /**
     * Prepare headers for V3 authentication
     */
    protected static function getHeaders()
    {
        return [
            'Authorization: Bearer ' . getenv('COINCAP_V3_KEY'),
            'Accept: application/json',
        ];
    }

    /**
     * Perform a GET request to the CoinCap API
     */
    public static function getRequest(string $url)
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            // inject V3 API key
            CURLOPT_HTTPHEADER     => self::getHeaders(),
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }

    /**
     * Base URL for V3
     */
    public static function domainUrl(): string
    {
        return 'https://rest.coincap.io/v3';
    }

    public static function allAssets()
    {
        $url = self::domainUrl() . '/assets';
        return self::getRequest($url);
    }

    public static function allAssetsWithLimit(int $limit)
    {
        $url = self::domainUrl() . "/assets?limit={$limit}";
        return self::getRequest($url);
    }

    public static function singleAsset(string $id)
    {
        $url = self::domainUrl() . "/assets/{$id}";
        return self::getRequest($url);
    }

    public static function assetHistory(string $id, string $interval)
    {
        $url = self::domainUrl() . "/assets/{$id}/history?interval={$interval}";
        return self::getRequest($url);
    }

    public static function assetMarket(string $id, int $limit)
    {
        $url = self::domainUrl() . "/assets/{$id}/markets?limit={$limit}";
        return self::getRequest($url);
    }

    public static function rates()
    {
        $url = self::domainUrl() . '/rates';
        return self::getRequest($url);
    }

    public static function singleRate(string $id)
    {
        $url = self::domainUrl() . "/rates/{$id}";
        return self::getRequest($url);
    }

    public static function exchanges()
    {
        $url = self::domainUrl() . '/exchanges';
        return self::getRequest($url);
    }

    public static function singleExchanges(string $id)
    {
        $url = self::domainUrl() . "/exchanges/{$id}";
        return self::getRequest($url);
    }

    public static function markets()
    {
        $url = self::domainUrl() . '/markets';
        return self::getRequest($url);
    }

    public static function marketsByExchangeId(string $exchangeId, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'exchangeId' => $exchangeId,
            'limit'      => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByBaseSymbol(string $baseSymbol, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'baseSymbol' => $baseSymbol,
            'limit'      => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByQuoteSymbol(string $quoteSymbol, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'quoteSymbol' => $quoteSymbol,
            'limit'       => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByBaseId(string $baseId, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'baseId' => $baseId,
            'limit'  => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByQuoteId(string $quoteId, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'quoteId' => $quoteId,
            'limit'   => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByAssetSymbol(string $assetSymbol, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'assetSymbol' => $assetSymbol,
            'limit'       => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function marketsByAssetId(string $assetId, int $limit = null)
    {
        $query = http_build_query(array_filter([
            'assetId' => $assetId,
            'limit'   => $limit,
        ]));
        $url = self::domainUrl() . "/markets?{$query}";
        return self::getRequest($url);
    }

    public static function candles(string $exchange, string $interval, string $baseId, string $quoteId, string $start = null, string $end = null)
    {
        $query = http_build_query(array_filter([
            'exchange' => $exchange,
            'interval' => $interval,
            'baseId'   => $baseId,
            'quoteId'  => $quoteId,
            'start'    => $start,
            'end'      => $end,
        ]));
        $url = self::domainUrl() . "/candles?{$query}";
        return self::getRequest($url);
    }
}
