<?php
    
    namespace Secco2112\Tinify\Handler\Response;

    use Secco2112\Tinify\Traits\DownloadHelper;

    class StoreResponse extends ResponseAbstract implements ResponseInterface {

        use DownloadHelper;

        private $_success = true;
        private $_error = false;

        public function __construct(array $data) {
            parent::__construct($data);
        }

        public function getUrl(): string {
            return $this->data['location'];
        }

        public function getWidth(): string {
            return $this->data['width'];
        }

        public function getHeight(): string {
            return $this->data['height'];
        }

        public function getOutputSource(): string {
            return $this->data['location'];
        }

        public function download($filename = ''): void {
            if($this->_filename !== '') {
                $_filename = $this->_filename;
            }
            if($filename !== '') {
                $_filename = $filename;
            }
            $contents = file_get_contents($this->getUrl());
            $this->downloadFromBlob($contents, $_filename);
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

        public function success(): bool {
            return $this->_success;
        }

        public function error(): bool {
            return $this->_error;
        }
            
    }