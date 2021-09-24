<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OrdersController extends Controller
{
    public function export(Request $request)
    {
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $url = "https://devyearbook.tamu.edu/wp-json/wc/v3/orders";

        $key = env('customer_key', '');
        $secret = env('customer_secret', '');

        $response = $client->get($url, ['auth' => [$key, $secret]]);
        $contents = (string) $response->getBody();
        $data = json_decode($contents);
        #print_r($data);
        $this->array_to_csv_download($data);
    }

    function array_to_csv_download($array) {

        $filename = "export.csv";
        $delimiter=",";

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');

        $f = fopen('php://output', 'w');

        $result = array();
        foreach ($array as $line) {
            $line = $line->id;
            array_push($result, $line);
            fputcsv($f, $line, $delimiter);
        }
        #print_r($result);
    }
}
