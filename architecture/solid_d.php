<?php

interface HttpInterface
{
    /**
     *
     * @param string $url
     * @param array $options
     */
     public function request(string $url, array $options = []);
}

class XMLHttpService implements HttpInterface
{
    /**
     *
     * @param string $url
     * @param array $options
     */
    public function request(string $url, array $options = [])
    {

    }
}

class Http
{
    private $service;

    public function __construct(HttpInterface $xmlHttpService)
    {
        $this->service = $xmlHttpService;
    }

    /**
     *
     * @param array $options
     * @param string $url
     */
    public function get(string $url, array $options)
    {
        $this->service->request($url, 'GET', $options);
    }

    /**
     *
     * @param string $url
     */
    public function post(string $url)
    {
        $this->service->request($url, 'GET');
    }
}