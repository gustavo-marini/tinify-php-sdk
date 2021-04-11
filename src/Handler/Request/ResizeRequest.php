<?php

    namespace Secco2112\Tinify\Handler\Request;

    use Secco2112\Tinify\Handler\Response\ResizeResponse;
    use Secco2112\Tinify\Handler\Response\ShrinkResponse;
    use Secco2112\Tinify\Options;
    use Secco2112\Tinify\Tinify;
    use Secco2112\Tinify\Traits\Functions;

    class ResizeRequest {

        use Functions;

        public function with(ShrinkResponse $response, array $resize_options): ResizeResponse {
            $output_url = str_replace(Options::TINIFYOPT_BASE_URL, '', $response->getUrl());
            $url = Options::TINIFYOPT_BASE_URL . $output_url;

            $body = [
                'resize' => $resize_options
            ];

            $response = $response->api->service()->post($url, $body);

            if($response) {
                return new ResizeResponse($response, $output_url);
            }
        }

        public function fromSource(string $source, array $resize_options, Tinify $api): ResizeResponse {
            $url = Options::TINIFYOPT_BASE_URL . $source;

            $body = [
                'resize' => $resize_options
            ];

            $response = $api->service()->post($url, $body);

            if($response) {
                return new ResizeResponse($response, $source);
            }
        }

    }