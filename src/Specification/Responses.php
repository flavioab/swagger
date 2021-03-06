<?php

namespace WakeOnWeb\Component\Swagger\Specification;

/**
 * @author Quentin Schuler <q.schuler@wakeonweb.com>
 */
class Responses
{
    /**
     * @var Response|null
     */
    private $default;

    /**
     * @var Response[]
     */
    private $responses;

    /**
     * @param Response|null $default
     * @param Response[]    $responses
     */
    public function __construct(Response $default = null, array $responses)
    {
        $this->default = $default;
        $this->responses = $responses;
    }

    /**
     * @return Response|null
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return Response[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param int $code
     *
     * @return Response|null
     */
    public function getResponseFor($code)
    {
        $code = (string) $code;

        $response = $this->default;

        if (isset($this->responses[$code])) {
            $response = $this->responses[$code];
        }

        if ($response instanceof ResponseReference) {
            $response = $response->resolve();
        }

        return $response;
    }
}
