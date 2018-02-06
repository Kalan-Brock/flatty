<?php

// Flatty API, by Kalan Brock @ The Biggest Nerd

namespace Flatty;

class FlattyAPI extends API {

    private $config;
    private $flatty;

    public function __construct($request, $origin) {
        parent::__construct($request);

        $this->config = new FlattyConfig();
        $this->flatty = new Flatty($request);

        /*if($this->flatty->exists())
            echo 'exists';
        else {
            echo 'does not exist.';
        }*/
        // methods for authenticating api keys and such can be implemented here.
        // keeping it simple for now by just restricting requests origin localhost.
    }

    /**
     * URL:  /flatty/example
     */
    protected function example() {
        if ($this->method == 'GET') {
            return 'Example Endpoint.  Request: '.json_encode($this->request).' Verb: '.json_encode($this->verb).' Args: '.json_encode($this->args);
        } else {
            return "Only accepts GET requests";
        }
    }
}