<?php

namespace ViralVector\LocalEvents\Drivers;

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
        $this->app_key = config('localevents.config.key');
    }

    /**
     * @param $params
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    public function search($params, $method = '/events/search')
    {
        $method = trim($method,'/');

        $client = new Client(['base_uri' => $this->api_root]);

        $query = new \stdClass();
        $query->app_key = $this->app_key;

        foreach ($params as $key => $value) {
            $query->$key = $value;
        }

        $response = $client->request('GET', "/rest/{$method}", [
            'query' => json_decode(json_encode($query), true),
        ]);

        $contents = $response->getBody()->getContents();

        if($response->getStatusCode() != 200)
            throw new \Exception($contents);

        $xmlelemt = simplexml_load_string($contents);

        if($xmlelemt->getName() == 'error'){
            throw new \Exception(var_dump($xmlelemt));
        }

        $results = (object)[
            'items' => []
        ];

        $model = config('localevents.model');
        $mapps = config('localevents.config.model_map');

        foreach ($xmlelemt->events as $event) {
            $item = json_decode(json_encode($event));
            if(isset($model)){
                $model = new $model;
                foreach ($mapps as $apiKey => $modelAttr){
                    $model->$modelAttr = $item[$apiKey];
                }
                $item = $model;
            }
            $results->items[] = $item;
        }

        return $results;
    }
}