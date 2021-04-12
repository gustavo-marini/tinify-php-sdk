<?php

    namespace Secco2112\Tinify\Handler\Request;

    use Secco2112\Tinify\Exception\InvalidStoreService;
    use Secco2112\Tinify\Handler\Response\ResponseInterface;
    use Secco2112\Tinify\Handler\Response\StoreResponse;
    use Secco2112\Tinify\Options;
    use Secco2112\Tinify\Traits\Functions;

    class StoreRequest {

        use Functions;

        private $_response;
        private $_source = '';

        private $validServices = [
            [
                'name' => Options::TINIFYOPT_STORE_SERVICE_S3,
                'options' => [

                ]
            ],
            [
                'name' => Options::TINIFYOPT_STORE_SERVICE_GCS,
                'options' => [
                    Options::TINIFYOPT_STORE_OPTION_GCP_ACCESS_TOKEN,
                    Options::TINIFYOPT_STORE_OPTION_HEADERS,
                    Options::TINIFYOPT_STORE_OPTION_PATH
                ]
            ]
        ];

        public function __construct(string $source = null) {
            $this->_source = $source;
        }

        public function with(ResponseInterface $response): StoreRequest {
            $this->_response = $response;
            return $this;
        }

        public function at(string $service, array $options) {
            $source = $this->_response->getOutputSource();
            if($this->_source !== '') {
                $source = $this->_source;
            }

            $valid = false;
            foreach($this->validServices as $s) {
                if($s['name'] === $service) {
                    $valid = !$valid;
                    break;
                }
            }

            if(!$valid) {
                throw new InvalidStoreService($service);
            } 

            $body = [
                'store' => [
                    'service' => $service
                ]
            ];
            $body['store'] = array_merge($body['store'], $options);

            $url = Options::TINIFYOPT_BASE_URL . $source;
            
            $request_service = $this->_response->api->service();
            $response = $request_service->post($url, $body);
            if($response) {
                $headers = $request_service->getLastRequestHeaders();

                $data = [
                    'location' => $headers['Location'],
                    'width' => $headers['Image-Width'],
                    'height' => $headers['Image-Height']
                ];

                return new StoreResponse($data);
            }
        }

    }