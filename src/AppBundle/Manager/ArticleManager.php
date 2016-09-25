<?php

namespace AppBundle\Manager;

use GuzzleHttp\ClientInterface;

/**
 * @author marouane
 */
class ArticleManager implements ArticleManagerInterface
{
    /**
     * @var ClientInterface
     */
    private $clientHttp;

    /**
     * @param ClientInterface $clientHttp
     */
    public function __construct(ClientInterface $clientHttp)
    {
        $this->clientHttp = $clientHttp;
    }

    /**
     * {@inherit doc}.
     */
    public function getAll()
    {
        $response = $this->clientHttp->request('GET', '/articles', ['headers' => ['Accept' => 'application/json']]);
        $body = $response->getBody()->getContents();

        return json_decode($body, true);
    }

    /**
     * {@inherit doc}.
     */
    public function get($uri)
    {
        $response = $this->clientHttp->request('GET', $uri, ['headers' => ['Accept' => 'application/json']]);
        $body = $response->getBody()->getContents();

        return json_decode($body, true);
    }

    /**
     * {@inherit doc}.
     */
    public function delete($uri)
    {
        $this->clientHttp->request('DELETE', $uri, ['headers' => ['Accept' => 'application/json']]);
    }

    /**
     * {@inherit doc}.
     */
    public function post(array $data)
    {
        $this->clientHttp->request('POST', '/articles', ['headers' => ['Accept' => 'application/json'], 'body' => json_encode($data)]);
    }
}
