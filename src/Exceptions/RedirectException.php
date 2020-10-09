<?php


namespace Developerhouse\Quick\Exceptions;


use Exception;

class RedirectException extends Exception {

    protected $response;

    /**
     * @return mixed
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * @param $response
     *
     * @return RedirectException
     */
    public function setResponse($response): self {
        $this->response = $response;
        return $this;
    }
}