<?php

    namespace Secco2112\Tinify;

    class Config {

        private $_config = [];

        public function __construct(array $options=[]) {
            $allowedOpts = [
                Options::TINIFYOPT_API_KEY
            ];

            foreach($options as $key => $opt) {
                if(in_array($key, $allowedOpts)) {
                    $this->_config[$key] = $opt;
                }
            }
        }

        public function get(string $key) {
            return $this->_config[$key] ?? '';
        }

        public function toArray(): array {
            return $this->_config;
        }

        public function toJson(): string {
            return json_encode($this->toArray());
        }

        public function toObject(): \stdClass {
            return json_decode($this->toJson());
        }

    }