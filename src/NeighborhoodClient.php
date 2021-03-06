<?php

namespace DiarioImoveis\ClientApi;

use GuzzleHttp\ClientInterface;

class NeighborhoodClient
{
    /**
     * Holds \GuzzleHttp\ClientInterface instance
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient = null;

    /**
     * returns object instance.
     *
     * @return void
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Performs http request to properties API
     *
     * @var int
     * @var array
     * @return string
     */
    public function get(int $advertiserId = null, array $params = [])
    {
        if (!$advertiserId) {
            throw new Exception('First param, advertiser id, invalid!');
        }

        $response = $this->httpClient->request('GET', '/api/neighborhoods-with-cities/' . $advertiserId, ['query' => $params]);
        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody());
        }// "200"

        throw new Exception('Request erros, code: ' . $response->getStatusCode());
    }
}
