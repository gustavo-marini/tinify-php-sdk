<?php

    namespace Secco2112\Tinify\Exception;

    use Exception;

    class FileDoesNotExists extends Exception {
        
        public function __construct($file) {
            parent::__construct('The path "' . $file . '" does not exists or is not a file.', 100, null);
        }
    
        public function __toString() {
            return $this->code . ': ' . $this->message;
        }

    }