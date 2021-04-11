<?php
    
    namespace Secco2112\Tinify\Handler\Response;

    class StoreResponse extends ResponseAbstract implements ResponseInterface {

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
            return '';
        }
            
    }