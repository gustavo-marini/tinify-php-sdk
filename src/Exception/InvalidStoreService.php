<?php

    namespace Secco2112\Tinify\Exception;

    use Exception;

    class InvalidStoreService extends Exception {
        
        public function __construct($service) {
            parent::__construct('The service "' . $service . '" is invalid.', 101, null);
        }
    
        public function __toString() {
            return $this->code . ': ' . $this->message;
        }

    }