<?php

// Flatty API, by Kalan Brock @ The Biggest Nerd

namespace Flatty;

class FlattyAPI {

    private $config;

    function __construct(FlattyConfig $config)
    {
        $this->config = $config;

        if(!empty($this->config->whitelist) && !in_array($_SERVER['REMOTE_ADDR'], $this->config->whitelist))
        {
            self::respond(['message' => 'rejected.']);
            die();
        }

        $this->handle();
    }

    private static function respond($data)
    {
        header('Content-type: application/json');
        echo json_encode( $data );
    }

    private function handle()
    {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'PUT':

                break;
            case 'POST':

                break;
            case 'GET':
                echo base64_decode('PCFkb2N0eXBlIGh0bWw+DQo8aHRtbCBsYW5nPSJlbiI+DQo8aGVhZD4NCiAgICA8bWV0YSBjaGFyc2V0PSJVVEYtOCI+DQogICAgPG1ldGEgbmFtZT0idmlld3BvcnQiDQogICAgICAgICAgY29udGVudD0id2lkdGg9ZGV2aWNlLXdpZHRoLCB1c2VyLXNjYWxhYmxlPW5vLCBpbml0aWFsLXNjYWxlPTEuMCwgbWF4aW11bS1zY2FsZT0xLjAsIG1pbmltdW0tc2NhbGU9MS4wIj4NCiAgICA8bWV0YSBodHRwLWVxdWl2PSJYLVVBLUNvbXBhdGlibGUiIGNvbnRlbnQ9ImllPWVkZ2UiPg0KICAgIDx0aXRsZT5mbGF0dHkuPC90aXRsZT4NCiAgICA8c3R5bGUgdHlwZT0idGV4dC9jc3MiPg0KICAgICAgICAqIHsNCiAgICAgICAgICAgIGNvbG9yOiAjMzMzOw0KICAgICAgICAgICAgZm9udC1mYW1pbHk6IHNlZ29lIHVpLCBoZWx2ZXRpY2EgbmV1ZSwgaGVsdmV0aWNhLCBhcmlhbCwgc2Fucy1zZXJpZjsNCiAgICAgICAgICAgIGZvbnQtd2VpZ2h0OiAzMDA7DQogICAgICAgICAgICAtd2Via2l0LWZvbnQtc21vb3RoaW5nOiBhbnRpYWxpYXNlZDsNCiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxOw0KICAgICAgICB9DQoNCiAgICAgICAgYm9keSwgaHRtbCB7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICBmb250LXNpemU6IDE2cHg7DQogICAgICAgIH0NCg0KICAgICAgICAud3JhcHBlciB7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICB3aWR0aDogNDAwcHg7DQogICAgICAgICAgICBtYXJnaW46IDAgYXV0bzsNCiAgICAgICAgICAgIHRleHQtYWxpZ246IGNlbnRlcjsNCiAgICAgICAgfQ0KICAgICAgICAud3JhcHBlcjpiZWZvcmUgew0KICAgICAgICAgICAgY29udGVudDogIiI7DQogICAgICAgICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7DQogICAgICAgICAgICBoZWlnaHQ6IDEwMCU7DQogICAgICAgICAgICB2ZXJ0aWNhbC1hbGlnbjogbWlkZGxlOw0KICAgICAgICAgICAgbWFyZ2luLWxlZnQ6IC0yZW07DQogICAgICAgIH0NCiAgICAgICAgLndyYXBwZXIgZGl2IHsNCiAgICAgICAgICAgIHZlcnRpY2FsLWFsaWduOiBtaWRkbGU7DQogICAgICAgICAgICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7DQogICAgICAgICAgICBtYXJnaW4tbGVmdDogMmVtOw0KICAgICAgICB9DQogICAgICAgIC53cmFwcGVyIGRpdiBoMSB7DQogICAgICAgICAgICBtYXJnaW46IDA7DQogICAgICAgICAgICBwYWRkaW5nOiAyMHB4IDA7DQogICAgICAgICAgICBkaXNwbGF5OiBibG9jazsNCiAgICAgICAgICAgIGZvbnQtc2l6ZTogMjAwJTsNCiAgICAgICAgfQ0KICAgICAgICAud3JhcHBlciBkaXYgcCB7DQogICAgICAgICAgICBtYXJnaW46IDA7DQogICAgICAgICAgICBwYWRkaW5nLWJvdHRvbTogMjBweDsNCiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrOw0KICAgICAgICAgICAgdGV4dC1hbGlnbjoganVzdGlmeTsNCiAgICAgICAgICAgIGxpbmUtaGVpZ2h0OiAxLjI7DQogICAgICAgICAgICBmb250LXNpemU6IDk1JTsNCiAgICAgICAgfQ0KDQogICAgPC9zdHlsZT4NCjwvaGVhZD4NCjxib2R5Pg0KPGRpdiBjbGFzcz0id3JhcHBlciI+DQogICAgPGRpdj4NCiAgICAgICAgPGgxPmZsYXR0eS48L2gxPg0KICAgICAgICA8cD5hIHNpbXBsZSwgZmxhdCBmaWxlIGRhdGFiYXNlIHdpdGggYW4gYXBpLjwvcD4NCiAgICA8L2Rpdj4NCjwvZGl2Pg0KPC9ib2R5Pg0KPC9odG1sPg==');
                break;
            case 'HEAD':

                break;
            case 'DELETE':

                break;
            case 'OPTIONS':

                break;
            default:

                break;
        }
    }
}