<?php

// Flatty API Handler, by Kalan Brock @ The Biggest Nerd

namespace Flatty;

class FlattyAPI extends API {

    private $config;
    private $flatty;

    public function __construct($request, $origin) {
        parent::__construct($request);

        $this->config = new FlattyConfig();
        $this->flatty = new Flatty($request);
    }

    public function processAPI()
    {
        if(!$this->table || !$this->key)
            return parent::processAPI();

        switch($this->method) {
            case 'DELETE':
            case 'POST':

                break;
            case 'GET':
                return $this->_response($this->flatty->result());
            case 'PUT':

                break;
            default:
                parent::_response('Invalid Method', 405);
                break;
        }
    }
}