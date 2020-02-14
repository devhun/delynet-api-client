<?php

namespace DevHun\Delynet\Adapter;

use DevHun\Delynet\DelynetClient;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

class GuzzleHttpAdapter extends AbstractAdapter
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var Response
     */
    protected $response;

    public function __construct()
    {
        $this->client = $this->buildClient();
    }

    /**
     * Helper function to build the Guzzle HTTP client.
     *
     * @param string $endpoint API endpoint
     *
     * @return Client
     */
    protected function buildClient($endpoint = null)
    {
        if ($endpoint === null) {
            $endpoint = DelynetClient::ENDPOINT;
        }

        $config = [
            'base_uri' => $endpoint,
            'headers'  => [
                'Accept'       => 'application/json',
                'User-Agent'   => sprintf('%s v%s (%s)', DelynetClient::AGENT, DelynetClient::VERSION, DelynetClient::URL)
            ],
        ];

        return new Client($config);
    }

    /**
     * {@inheritdoc}
     */
    public function setEndpoint($endpoint)
    {
        $this->client = $this->buildClient($endpoint);
    }

    /**
     * {@inheritDoc}
     */
    public function get($url, array $args = [])
    {
        $options = [];

        // Add additional arguments to the defaults:
        if (!empty($args)) {
            $options['query'] = $args;
        }

        try {
            $this->response = $this->client->get($url, $options);

            $this->handleError();
        } catch (RequestException $e) {
            $this->response = $e->getResponse();

            return $this->handleError();
        }

        return json_decode($this->response->getBody(), true);
    }

    /**
     * {@inheritDoc}
     */
    public function post($url, array $args, array $files = [])
    {
        if (is_array($files) && !empty($files)) {
            $postData = [];
            foreach ($args as $key => $val) {
                array_push($postData, [
                    'name'     => $key,
                    'contents' => $val,
                ]);
            }
            $postMode = 'multipart';

            foreach ($files as $key => $val) {
                array_push($postData, [
                    'name'     => $key,
                    'contents' => fopen($val, 'r'),
                    'filename' => basename($val),
                ]);
            }
        } else {
            $postData = $args;
            $postMode = 'form_params';
        }
        $options[$postMode] = $postData;

        try {
            $this->response = $this->client->post($url, $options);

            $this->handleError();
        } catch (RequestException $e) {
            $this->response = $e->getResponse();
            $this->handleError();
        }

        return json_decode($this->response->getBody(), true);
    }

    protected function handleError()
    {
        $code = (int) $this->response->getStatusCode();
        $response = (string) $this->response->getBody();

        $this->reportError($code, $response);
    }
}