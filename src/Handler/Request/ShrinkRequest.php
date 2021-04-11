<?php

    namespace Secco2112\Tinify\Handler\Request;

    use Secco2112\Tinify\Handler\Response\ResponseInterface;
    use Secco2112\Tinify\Handler\Response\ShrinkResponse;
    use Secco2112\Tinify\Options;
    use Secco2112\Tinify\Tinify;
    use Secco2112\Tinify\Traits\Functions;

    class ShrinkRequest {

        use Functions;

        public function fromFile(Tinify $api, string $file): ResponseInterface {
            $contents = file_get_contents($file);
            $filename = pathinfo($file, PATHINFO_FILENAME);

            $url = Options::TINIFYOPT_BASE_URL . '/shrink';
            $response = $api->service()->post($url, $contents);

            if($response) {
                $this->convertToArrayIfJson($response);
                return new ShrinkResponse($response, $api, $filename);
            } else {
                return new ShrinkResponse([], $api, '', true);
            }
        }

        public function fromUrl(Tinify $api, string $file_url): ResponseInterface {
            $filename = pathinfo($file_url, PATHINFO_FILENAME);

            $url = Options::TINIFYOPT_BASE_URL . '/shrink';
            $body = ['source' => ['url' => $file_url]];
            $response = $api->service()->post($url, $body);

            if($response) {
                $this->convertToArrayIfJson($response);
                return new ShrinkResponse($response, $api, $filename);
            } else {
                return new ShrinkResponse([], $api, '', true);
            }
        }

        public function fromBlob(Tinify $api, string $file_contents): ResponseInterface {
            $url = Options::TINIFYOPT_BASE_URL . '/shrink';
            $response = $api->service()->post($url, $file_contents);

            if($response) {
                $this->convertToArrayIfJson($response);
                return new ShrinkResponse($response, $api);
            } else {
                return new ShrinkResponse([], $api, '', true);
            }
        }

    }