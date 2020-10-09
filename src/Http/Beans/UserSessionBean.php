<?php

namespace Developerhouse\Quick\Http\Beans;

class UserSessionBean {
    private $user_id;
    private $ip_address;
    private $user_agent;
    private $medium_id;
    private $state_id;

    /**
     * UserSessionBean constructor.
     */
    public function __construct() { }

    /**
     * @return null
     */
    public function getUserId() {
        return $this->user_id;
    }

    /**
     * @param null $user_id
     */
    public function setUserId($user_id): void {
        $this->user_id = $user_id;
    }

    /**
     * @return null
     */
    public function getIpAddress() {
        return $this->ip_address;
    }

    /**
     * @param null $ip_address
     */
    public function setIpAddress($ip_address): void {
        $this->ip_address = $ip_address;
    }

    /**
     * @return null
     */
    public function getUserAgent() {
        return $this->user_agent;
    }

    /**
     * @param null $user_agent
     */
    public function setUserAgent($user_agent): void {
        $this->user_agent = $user_agent;
    }

    /**
     * @return null
     */
    public function getMediumId() {
        return $this->medium_id;
    }

    /**
     * @param null $medium_id
     */
    public function setMediumId($medium_id): void {
        $this->medium_id = $medium_id;
    }

    /**
     * @return null
     */
    public function getStateId() {
        return $this->state_id;
    }

    /**
     * @param null $state_id
     */
    public function setStateId($state_id): void {
        $this->state_id = $state_id;
    }


}
