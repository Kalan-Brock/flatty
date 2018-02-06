<?php

namespace Flatty;

abstract class API {
    /**
     * Property: method
     * The HTTP method this request was made in, either GET, POST, PUT or DELETE
     */
    protected $method = '';
    /**
     * Property: endpoint
     * The Model requested in the URI. eg: /files
     */
    protected $endpoint = '';
    /**
     * Property: verb
     * An optional additional descriptor about the endpoint, used for things that can
     * not be handled by the basic methods. eg: /files/process
     */
    protected $verb = '';
    /**
     * Property: args
     * Any additional URI components after the endpoint and verb have been removed, in our
     * case, an integer ID for the resource. eg: /<endpoint>/<verb>/<arg0>/<arg1>
     * or /<endpoint>/<arg0>
     */
    protected $args = Array();
    /**
     * Property: file
     * Stores the input of the PUT request
     */
    protected $file = Null;

    /**
     * Constructor: __construct
     * Allow for CORS, assemble and pre-process the data
     */
    public function __construct($request) {
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: *");

        $this->args = explode('/', rtrim($request, '/'));
        $this->endpoint = array_shift($this->args);
        if (array_key_exists(0, $this->args) && !is_numeric($this->args[0])) {
            $this->verb = array_shift($this->args);
        }

        $this->method = $_SERVER['REQUEST_METHOD'];
        if ($this->method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
            if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                $this->method = 'DELETE';
            } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                $this->method = 'PUT';
            } else {
                throw new Exception("Unexpected Header");
            }
        }

        switch($this->method) {
            case 'DELETE':
            case 'POST':
                $this->request = $this->_cleanInputs($_POST);
                break;
            case 'GET':
                $this->request = $this->_cleanInputs($_GET);
                break;
            case 'PUT':
                $this->request = $this->_cleanInputs($_GET);
                $this->file = file_get_contents("php://input");
                break;
            default:
                $this->_response('Invalid Method', 405);
                break;
        }
    }

    public function processAPI()
    {
        if (method_exists($this, $this->endpoint)) {
            return $this->_response($this->{$this->endpoint}($this->args));
        }
        //return $this->_response("No Endpoint: $this->endpoint", 404);
        return base64_decode('PCFkb2N0eXBlIGh0bWw+DQo8aHRtbCBsYW5nPSJlbiI+DQo8aGVhZD4NCiAgICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+DQogICAgPG1ldGEgbmFtZT0idmlld3BvcnQiDQogICAgICAgICAgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCB1c2VyLXNjYWxhYmxlPW5vLCBpbml0aWFsLXNjYWxlPTEuMCwgbWF4aW11bS1zY2FsZT0xLjAsIG1pbmltdW0tc2NhbGU9MS4wIj4NCiAgICA8bWV0YSBodHRwLWVxdWl2PSJYLVVBLUNvbXBhdGlibGUiIGNvbnRlbnQ9ImllPWVkZ2UiPg0KICAgIDx0aXRsZT5mbGF0dHkuPC90aXRsZT4NCiAgICA8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KICAgICAgICAqIHsNCiAgICAgICAgICAgIGNvbG9yOiAjMzMzOw0KICAgICAgICAgICAgZm9udC1mYW1pbHk6IHNlZ29lIHVpLCBoZWx2ZXRpY2EgbmV1ZSwgaGVsdmV0aWNhLCBhcmlhbCwgc2Fucy1zZXJpZjsNCiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiAzMDA7DQogICAgICAgICAgICAtd2Via2l0LWZvbnQtc21vb3RoaW5nOiBhbnRpYWxpYXNlZDsNCiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxOw0KICAgICAgICB9DQoNCiAgICAgICAgYm9keSwgaHRtbCB7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICBmb250LXNpemU6IDE2cHg7DQogICAgICAgIH0NCg0KICAgICAgICAud3JhcHBlciB7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICB3aWR0aDogNDAwcHg7DQogICAgICAgICAgICBtYXJnaW46IDAgYXV0bzsNCiAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjsNCiAgICAgICAgfQ0KICAgICAgICAud3JhcHBlcjpiZWZvcmUgew0KICAgICAgICAgICAgY29udGVudDogIiI7DQogICAgICAgICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICB2ZXJ0aWNhbC1hbGlnbjogbWlkZGxlOw0KICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IC0yZW07DQogICAgICAgIH0NCiAgICAgICAgLndyYXBwZXIgZGl2IHsNCiAgICAgICAgICAgIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7DQogICAgICAgICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7DQogICAgICAgICAgICBtYXJnaW4tbGVmdDogMmVtOw0KICAgICAgICB9DQogICAgICAgIC53cmFwcGVyIGRpdiBoMSB7DQogICAgICAgICAgICBtYXJnaW46IDA7DQogICAgICAgICAgICBwYWRkaW5nOiAyMHB4IDA7DQogICAgICAgICAgICBkaXNwbGF5OiBibG9jazsNCiAgICAgICAgICAgIGZvbnQtc2l6ZTogMjAwJTsNCiAgICAgICAgfQ0KICAgICAgICAud3JhcHBlciBkaXYgcCB7DQogICAgICAgICAgICBtYXJnaW46IDA7DQogICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDsNCiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrOw0KICAgICAgICAgICAgdGV4dC1hbGlnbjoganVzdGlmeTsNCiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxLjI7DQogICAgICAgICAgICBmb250LXNpemU6IDk1JTsNCiAgICAgICAgfQ0KDQogICAgPC9zdHlsZT4NCjwvaGVhZD4NCjxib2R5Pg0KPGRpdiBjbGFzcz0id3JhcHBlciI+DQogICAgPGRpdj4NCiAgICAgICAgPGgxPmZsYXR0eS48L2gxPg0KICAgICAgICA8cD5hIHNpbXBsZSwgZmxhdCBmaWxlIGRhdGFiYXNlIHdpdGggYW4gYXBpLjwvcD4NCiAgICA8L2Rpdj4NCjwvZGl2Pg0KPC9ib2R5Pg0KPC9odG1sPg==');
    }


    private function _response($data, $status = 200) {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        return json_encode($data);
    }

    private function _cleanInputs($data) {
        $clean_input = Array();
        if (is_array($data)) {
            foreach ($data as $k => $v) {
                $clean_input[$k] = $this->_cleanInputs($v);
            }
        } else {
            $clean_input = trim(strip_tags($data));
        }
        return $clean_input;
    }

    private function _requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }
}
