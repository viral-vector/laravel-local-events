<?php

namespace ViralVector\LocalEvents\Drivers;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use GuzzleHttp\Client;
use ViralVector\LocalEvents\Contracts\LocalEventsSearchInterface;

class EventfulLocalEventsDriver implements LocalEventsSearchInterface
{
    /**
     * URI of the REST API
     *
     * @access  public
     * @var     string
     */
    private $api_root = 'http://api.eventful.com/rest';

    /**
     * Application key (as provided by http://api.eventful.com)
     *
     * @access  public
     * @var     string
     */
    private $app_key   = null;

    /**
     * Create a new client
     *
     * @access  public
     * @param   string      app_key
     */
    function __construct()
    {
        $this->app_key = config('localevents.key');
    }

    /**
     * @param $query
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function search($query, $method = '/events/search')
    {
        $method = trim($method,'/');

        $client = new Client(['base_uri' => $this->api_root]);

        $query = new \stdClass();
        $query->app_key = $this->app_key;

        $response = $client->request('GET', $method, [
            'query' => json_decode(json_encode($query), true)
        ]);

        return $response;
    }
}