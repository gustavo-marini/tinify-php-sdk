<?php

    namespace Secco2112\Tinify\Handler\Response;

    use Secco2112\Tinify\Handler\Request\ResizeRequest;
    use Secco2112\Tinify\Handler\Request\ShrinkRequest;
    use Secco2112\Tinify\Handler\Request\StoreRequest;
    use Secco2112\Tinify\Options;
    use Secco2112\Tinify\Tinify;
    use Secco2112\Tinify\Traits\DownloadHelper;

    class ShrinkResponse extends ResponseAbstract implements ResponseInterface {

        use DownloadHelper;

        public $api;
        private $_filename = '';
        private $_success = true;
        private $_error = false;

        public function __construct($body, Tinify $api, string $filename = '', $error = false) {
            if($error === false) {
                $this->api = $api;
                $this->_filename = $filename;
                parent::__construct($body);
            } else {
                $this->_error = true;
                $this->success = false;
                $data = [
                    'error' => true
                ];
                parent::__construct($data);
            }
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
            if($this->_filename !== '') {
                $_filename = $this->_filename;
            }
            if($filename !== '') {
                $_filename = $filename;
            }
            $this->downloadFromUrl($this->getUrl(), $_filename, $this->getOutputType());
        }

        public function toRawData(): string {
            $contents = $this->api->service()->get($this->getUrl());
            return $contents;
        }

        public function saveAt($path, $filename): string {
            $contents = $this->toRawData();

            while(in_array($path[strlen($path) - 1], ['/', '\\'])) {
                $path = substr($path, 0, -1);
            }

            $file = fopen($path . DIRECTORY_SEPARATOR . $filename, 'wb');
            fwrite($file, $contents);
            fclose($file);

            return realpath($path . DIRECTORY_SEPARATOR . $filename);
        }

        public function forceOptmize(float $max_optmize_percentage = 5, int $max_iterations = 10) {
            $file = $this->getUrl();
            $original_image_size = $this->getInputSize();
            $new_file_size = $this->getOutputSize();
            $diff_percent = 100 - (($new_file_size * 100) / $original_image_size);
            $shrink = $this;
            
            while($diff_percent >= $max_optmize_percentage) {
                $shrink = (new ShrinkRequest)->fromUrl($this->api, $file);
                $file = $shrink->getUrl();
                $original_image_size = $shrink->getInputSize();
                $new_file_size = $shrink->getOutputSize();
                $diff_percent = 100 - (($new_file_size * 100) / $original_image_size);
                
                if(--$max_iterations === 0) break;
            }

            return $shrink;
        }

        public function resize(array $options): ResizeResponse {
            return (new ResizeRequest)->with($this, $options);
        }

        public function store(): StoreRequest {
            return (new StoreRequest)->with($this);
        }

        public function success(): bool {
            return $this->_success;
        }

        public function error(): bool {
            return $this->_error;
        }

    }