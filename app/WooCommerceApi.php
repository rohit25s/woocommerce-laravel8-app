<?php
namespace App;
use Automattic\WooCommerce\Client;
use Automattic\WooCommerce\HttpClient\HttpClientException;
use stdClass;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WooCommerceApi
{
    private $woocommerce;
    private $endpoint;

    private $data;
//$headers = array(
//   'Content-Type: application/json'
);

//$method = "POST";
//$url = "http://localhost/Test/wc-api/v2/orders/123?oauth_consumer_key=ck_mykey&consumer_key=ck_mykey&consumer_secret=cs_mykey&oauth_timestamp=1505544895&oauth_nonce=9ecd49e80860e09ddaf91f148451532620976b8d&oauth_signature_method=HMAC-SHA256&oauth_signature=mysignature";
//$Result = callApi($url, json_encode($data), $headers, $method);

echo '<pre>'; print_r($Result);



     /**
     * Build Woocommerce connection.
     *
     * @return void
     */
    public function __construct()
    {
        try {
             // using guzzle
             $this->data = new stdClass();
             $data->fulfillment = new stdClass();

$trackingUrl = "123456789";

$shopUrl = "localhost/Test";
$consumerKey = "cs_mykey";
$consumerSecret = "ck_mykey";
$orderId = "123";

$subPath = "/wc-api/v2/orders/".$orderId;

$data->fulfillment->tracking_url = $trackingUrl;
$data->fulfillment->status = 'completed';

/*

            $this->endpoint = config('woocommerce.store_url');
            $this->headers = [
                'header_total'       => config('woocommerce.header_total') ?? 'X-WP-Total',
                'header_total_pages' => config('woocommerce.header_total_pages') ?? 'X-WP-TotalPages',
            ];

            $this->woocommerce = new Client(
                $this->endpoint,
                config('woocommerce.store_url'),
                config('woocommerce.consumer_key'),
                config('woocommerce.consumer_secret'),
                [
                    'version'           => 'wc/'.config('woocommerce.api_version'),
                    'wp_api'            => config('woocommerce.wp_api_integration'),
                    'verify_ssl'        => config('woocommerce.verify_ssl'),
                    'query_string_auth' => config('woocommerce.query_string_auth'),
                    'timeout'           => config('woocommerce.timeout'),
                ]
            );
        } catch (\Exception $e) {
             throw new \Exception($e->getMessage(), 1);
        }
        */
    }

    public function getWc(){
            $this->woocommerce->get($this->endpoint, $parameters = []);
    }

    public function postWc($data){
    $this->woocommerce->post($this->endpoint, $data);
    }

    public function putWc($data){
    $this->woocommerce->put($this->endpoint, $data);
    }

    public function deleteWc(){
    $this->woocommerce->delete($this->endpoint, $parameters = []);
    }

    public function optionsWc(){
    $this->woocommerce->options($this->endpoint);
    }

    public function get_posts($query_args){
        return $this->woocommerce->get($this->endpoint, $parameters = $query_args);
    }

    public function get_payment_methods_all_orders(){

    return $order->get_payment_method();
    }

    public function sv_get_refunded_orders() {

        $query_args = array(
            'fields'         => 'id=>parent',
            'post_type'      => 'shop_order_refund',
            'post_status'    => 'any',
            'posts_per_page' => 999999999999,
        );

        $refunds = $this->get_posts( $query_args );

        return $refunds;
    }

    public function printWc(){
        try {
            $results = $this->woocommerce->get('customers');
            // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', 'email' => ...
            echo '<pre><code>' . print_r( $results, true ) . '</code><pre>'; // JSON output.

            // Last request data.
            $lastRequest = $this->woocommerce->http->getRequest();
            echo '<pre><code>' . print_r( $lastRequest->getUrl(), true ) . '</code><pre>'; // Requested URL (string).
            echo '<pre><code>' . print_r( $lastRequest->getMethod(), true ) . '</code><pre>'; // Request method (string).
            echo '<pre><code>' . print_r( $lastRequest->getParameters(), true ) . '</code><pre>'; // Request parameters (array).
            echo '<pre><code>' . print_r( $lastRequest->getHeaders(), true ) . '</code><pre>'; // Request headers (array).
            echo '<pre><code>' . print_r( $lastRequest->getBody(), true ) . '</code><pre>'; // Request body (JSON).

            // Last response data.
            $lastResponse = $this->woocommerce->http->getResponse();
            echo '<pre><code>' . print_r( $lastResponse->getCode(), true ) . '</code><pre>'; // Response code (int).
            echo '<pre><code>' . print_r( $lastResponse->getHeaders(), true ) . '</code><pre>'; // Response headers (array).
            echo '<pre><code>' . print_r( $lastResponse->getBody(), true ) . '</code><pre>'; // Response body (JSON).

        } catch (HttpClientException $e) {
            echo '<pre><code>' . print_r( $e->getMessage(), true ) . '</code><pre>'; // Error message.
            echo '<pre><code>' . print_r( $e->getRequest(), true ) . '</code><pre>'; // Last request data.
            echo '<pre><code>' . print_r( $e->getResponse(), true ) . '</code><pre>'; // Last response data.
        }
    }
}
