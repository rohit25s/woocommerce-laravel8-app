
<?php

namespace app;
require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;


class WooCommerceApi
{
    private $woocommerce;
    private $endpoint;


     /**
     * Build Woocommerce connection.
     *
     * @return void
     */
    public function __construct()
    {
        try {
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
}
