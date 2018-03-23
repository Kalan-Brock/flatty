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

    public function latestEntryNumeric()
    {
        $d = scandir($this->flatty->path.$this->table, SCANDIR_SORT_DESCENDING);

        return (int)str_replace('.json', '', $d[0]);
    }

    public function nextEntryNumeric()
    {
        return (int)$this->latestEntryNumeric() + 1;
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