<?php

    namespace Secco2112\Tinify\Service;

    use GuzzleHttp\Exception\RequestException;
    use GuzzleHttp\RequestOptions;

    class ServiceDefault implements ServiceInterface {

        private static $__instance = null;
        private $_http_client = null;

        private $_last_request_url = null;
        private $_last_status_code = null;
        private $_last_request_headers = [];

        private $_api_key = null;

        private function __construct() {
            $this->_http_client = new \GuzzleHttp\Client([
                RequestOptions::HTTP_ERRORS => false
            ]);
        }

        public static function getInstance(): ServiceDefault {
            if(is_null(self::$__instance)) {
                self::$__instance = new self;
            }
            return self::$__instance;
        }

        public function getLastRequestUrl() {
            return $this->_last_request_url;
        }

        public function getLastStatusCode() {
            return $this->_last_status_code;
        }

        public function getLastRequestHeaders() {
            return $this->_last_request_headers;
        }

        public function setApiKey(string $api_key): ServiceDefault {
            $this->_api_key = $api_key;
            return $this;
        }

        public function request(string $method, string $uri, $body = null) {
            $this->_last_request_url = $uri;

            $options = [];
            if($body != null) {
                if(is_string($body)) {
                    $options[\GuzzleHttp\RequestOptions::BODY] = $body;
                }
                if(is_array($body)) {
                    $options[\GuzzleHttp\RequestOptions::JSON] = $body;
                }
            }
            
            $options['headers'] = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('api:' . $this->_api_key)
            ];

            try{
                /* @var \Psr\Http\Message\ResponseInterface $response */
                $response = $this->_http_client->{$method}($uri, $options);

                $this->_last_status_code = $response->getStatusCode();
                $this->_last_request_headers = $response->getHeaders();

                return $response->getBody()->getContents();
            }catch(RequestException $e){
                return false;
            }
        }

        public function post(string $url, $body = null) {
            return $this->request(self::REQUEST_METHOD_POST, $url, $body);
        }

        public function put(string $url, $body = null) {
            return $this->request(self::REQUEST_METHOD_PUT, $url, $body);
        }

        public function patch(string $url, $body = null) {
            return $this->request(self::REQUEST_METHOD_PATCH, $url, $body);
        }

        public function get(string $url) {
            return $this->request(self::REQUEST_METHOD_GET, $url);
        }

        public function delete(string $url, $body = null) {
            return $this->request(self::REQUEST_METHOD_DELETE, $url, $body);
        }

        public function head(string $url) {
            return $this->request(self::REQUEST_METHOD_HEAD, $url);
        }

    }