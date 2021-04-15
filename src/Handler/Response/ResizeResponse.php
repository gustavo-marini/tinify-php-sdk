<?php
    
    namespace Secco2112\Tinify\Handler\Response;

    use Secco2112\Tinify\Traits\DownloadHelper;

    class ResizeResponse implements ResponseInterface {

        use DownloadHelper;

        private $_file_contents;
        private $_source;
        private $_success = true;
        private $_error = false;

        public function __construct(string $contents, string $source) {
            $this->_file_contents = $contents;
            $this->_source = $source;
        }

        public function toBinary(): string {
            return $this->_file_contents;
        }

        public function download($filename = ''): void {
            $this->downloadFromBlob($this->_file_contents, $filename);
        }

        public function toRawData(): string {
            return $this->_file_contents;
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

        public function getOutputSource(): string {
            return $this->_source;
        }

        public function success(): bool {
            return $this->_success;
        }

        public function error(): bool {
            return $this->_error;
        }
            
    }