<?php

namespace Developerhouse\Quick\Helper;

class ClassHelpers {


    protected $name;

    /**
     * helpers constructor.
     *
     * @param string $name
     */
    public function __construct($name = 'Daniel') {
        $this->name = $name;
    }

    public function helloWord() {
        return "Hello, {$this->name}";
    }
}