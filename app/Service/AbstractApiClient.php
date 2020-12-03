<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Log\Logger;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Support\Str;
use SimpleXMLElement;

/**
 * @method object get($uri, ...$args)
 * @method object post($uri, ...$data)
 * @method object put($uri, ...$data)
 * @method object patch($uri, ...$data)
 * @method object head($uri, ...$data)
 * @method object delete($uri)
 */
abstract class AbstractApiClient
{
    protected $cache;
    protected $logger;
    protected $client;
    protected $responseFormat = 'json';

    /**
     * The query parameter name for the key
     * For example, last.fm use api_key like this:
     * https://ws.audioscrobbler.com/2.0?method=artist.getInfo&artist=Kamelot&api_key=API_KEY.
     * @var string
     */
    protected $KeyParam = 'key';

    public function __construct(Client $client, Cache $cache, Logger $logger)
    {
        $this->cache = $cache;
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Make a request to the API.
     *
     * @param string $method The HTTP method
     * @param string $uri The API URI (segment)
     * @param bool $appendKey Whether to automatically append the API key into the URI.
     *                           While it's usually the case, some services (like Last.fm) requires
     *                           an "API signature" of the request. Appending an API key will break the request.
     * @param mixed[] $params An array of parameters
     *
     * @return mixed|SimpleXMLElement|null
     */
    public function request(string $method, string $uri, bool $appendKey = true, array $params = [])
    {
        try {
            $body = (string)$this->getClient()
                ->$method($this->buildUrl($uri, $appendKey))
                ->getBody();

            if ($this->responseFormat === 'json') {
                return json_decode($body);
            }

            if ($this->responseFormat === 'xml') {
                return simplexml_load_string($body);
            }
            return $body;
        } catch (ClientException $exception) {
            $this->logger->error($exception);
        }
    }


    /**
     * Make an HTTP call to the external resource.
     *
     * @param string  $method The HTTP method
     * @param mixed[] $args   An array of parameters
     *
     *
     * @return mixed|SimpleXMLElement|null
     */
    public function __call(string $method, array $args)
    {
        if (count($args) < 1) {
            throw new \InvalidArgumentException('Magic request methods require a URI and optional options array');
        }

        $uri = $args[0];
        $opts = isset($args[1]) ? $args[1] : [];
        $appendKey = isset($args[2]) ? $args[2] : [];

        return $this->request($method, $uri, $appendKey, $opts);
    }

    public function buildUrl(string $uri, bool $appendKey = true): string
    {
        if (!Str::startsWith($uri, ['http://', 'https://'])) {
            if ($uri[0] !== '/') {
                $uri = "/$uri";
            }
            $uri = $this->$this->getEndpoint() . $uri;
        }

        if ($appendKey) {
            if (parse_url($uri, PHP_URL_QUERY)) {
                $uri .= "&{$this->KeyParam}=" . $this->getKey();
            } else {
                $uri .= "?{$this->KeyParam}=" . $this->getKey();
            }
        }
        return $uri;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    abstract public function getKey(): ?string;

    abstract public function getSecret(): ?string;

    abstract public function getEndpoint(): ?string;
}
