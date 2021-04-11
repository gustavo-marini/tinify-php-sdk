<?php

    namespace Secco2112\Tinify\Handler\Response;

    abstract class ResponseAbstract{

        protected $data;

        public function __construct($body) {
            $this->buildData($body);
        }

        private function buildData($body) {
            foreach($body as $key => $value) {
                $this->data[$key] = $value;
            }
        }

        public function __set($name, $value) {
            $this->data[$name] = $value;
        }

        public function toJson(): string {
            return json_encode($this->data);
        }

        public function toArray(): array {
            return $this->data;
        }

        public function toObject(): \stdClass {
            return json_decode(json_encode($this->data));
        }

    }