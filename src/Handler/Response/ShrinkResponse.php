<?php

    namespace Secco2112\Tinify\Handler\Response;

    use Secco2112\Tinify\Handler\Request\ResizeRequest;
    use Secco2112\Tinify\Handler\Request\StoreRequest;
    use Secco2112\Tinify\Options;
    use Secco2112\Tinify\Tinify;
    use Secco2112\Tinify\Traits\DownloadHelper;

    class ShrinkResponse extends ResponseAbstract implements ResponseInterface {

        use DownloadHelper;

        public $api;
        private $filename = '';

        public function __construct($body, Tinify $api, string $filename = '') {
            $this->api = $api;
            $this->filename = $filename;
            parent::__construct($body);
        }

        public function getInputSize(): int {
            return $this->data['input']['size'];
        }

        public function getInputType(): string {
            return $this->data['input']['type'];
        }

        public function getOutputSize(): int {
            return $this->data['output']['size'];
        }

        public function getOutputType(): string {
            return $this->data['output']['type'];
        }

        public function getOutputWidth(): int {
            return $this->data['output']['width'];
        }

        public function getOutputHeight(): int {
            return $this->data['output']['height'];
        }

        public function getRatio(): float {
            return $this->data['output']['radio'];
        }

        public function getUrl(): string {
            return $this->data['output']['url'];
        }

        public function getOutputSource(): string {
            return str_replace(Options::TINIFYOPT_BASE_URL, '', $this->getUrl());
        }

        public function download($filename = ''): void {
            if($this->filename !== '') {
                $_filename = $this->filename;
            }
            if($filename !== '') {
                $_filename = $filename;
            }
            $this->downloadFromUrl($this->getUrl(), $_filename, $this->getOutputType());
        }

        public function resize(array $options): ResizeResponse {
            return (new ResizeRequest)->with($this, $options);
        }

        public function store(): StoreRequest {
            return (new StoreRequest)->with($this);
        }

    }