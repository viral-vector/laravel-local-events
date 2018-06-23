<?php

namespace ViralVector\LocalEvents\Drivers;

use GuzzleHttp\Client;
use ViralVector\LocalEvents\CompoundMap;
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

        $query = [];
        $query['app_key'] = $this->app_key;

        foreach ($params as $key => $value) {
            $query[$key] = $value;
        }

        $response = $client->request('GET', "/rest/{$method}", [
            'query' => $query,
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

        foreach ($xmlelemt->events->event as $event) {
            if(isset($model)){
                $attr = [];
                foreach ($mapps as $model_key => $api_key){
                    if(is_object($api_key) && get_class($api_key) == CompoundMap::class){


                        $map = $api_key->getMap();
                        $data = [];
                        foreach ($map as $key => $name) {
                            if(is_array($name)) {
                                $value = [];
                                foreach ($name as $k){
                                    $part = (string)($event->attributes()->$k ?: $event->$k);
                                    if(isset($value))
                                        $value[] = $part;
                                }
                            }else {
                                $value = (string)($event->attributes()->$name ?: $event->$name);
                            }

                            if(isset($value))
                                $data[$key] = $value;
                        }
                        $data = $api_key->format($data);


                    } elseif(is_array($api_key)){

                        $data = [];
                        foreach ($api_key as $key){
                            $value = (string)($event->attributes()->$key ?: $event->$key);
                            if(isset($value))
                                $data[] = $value;
                        }
                        $data = implode(', ', $data);

                    } else {

                        $data = (string)($event->attributes()->$api_key ?: $event->$api_key);

                    }
                    $attr[$model_key] = $data;
                }
                $item = new $model($attr);
            }else{
                $item = json_decode(json_encode($event));
            }
            $results->items[] = $item;
        }

        return $results;
    }
}