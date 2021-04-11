<?php
    
    namespace Secco2112\Tinify\Handler\Response;

    use Secco2112\Tinify\Traits\DownloadHelper;

    class ResizeResponse implements ResponseInterface {

        use DownloadHelper;

        private $file_contents;
        private $source;

        public function __construct(string $contents, string $source) {
            $this->file_contents = $contents;
            $this->source = $source;
        }

        public function toBinary(): string {
            return $this->file_contents;
        }

        public function download($filename) {
            $this->downloadFromBlob($this->file_contents, $filename);
        }

        public function getOutputSource(): string {
            return $this->source;
        }
            
    }