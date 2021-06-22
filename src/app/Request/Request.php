<?php

namespace App\Request;

/**
 * Class Request
 * @package App
 */
class Request implements RequestInterface
{
    /**
     * @var string|mixed
     */
    private string $requestMethod;

    private string $requestUri;

    /**
     * Request constructor.
     * @param string $uri
     * @param string $method
     */
    public function __construct(string $uri, string $method = 'GET')
    {
        $this->requestUri = $uri;
        $this->requestMethod = $method;
        $this->bootstrapSelf();
    }

    /**
     *
     */
    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    /**
     * @param $string
     * @return array|string|string[]
     */
    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    /**
     * @return array|void
     */
    public function getBody()
    {
        if ($this->requestMethod === "GET") {
            return;
        }

        if ($this->requestMethod == "POST") {
            $body = array();
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }

            return $body;
        }
    }

    public function getMethod(): string
    {
        return $this->requestMethod;
    }

    public function getUri(): string
    {
        return $this->requestUri;
    }

    public function isGetMethod(): bool
    {
        if ('GET' === $this->getMethod()) {
            return true;
        }

        return false;
    }
}
