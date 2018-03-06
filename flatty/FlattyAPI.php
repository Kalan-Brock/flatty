<?php

// Flatty API Handler, by Kalan Brock @ The Biggest Nerd
// We love hacky projects! Give us a shout, I'm probably awake. - kalan@thebiggestnerd.com

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
        }
        /*
         *
         * Still working this part out, probably need to handle $request differently.
         */
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