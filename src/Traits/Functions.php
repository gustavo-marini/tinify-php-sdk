<?php

    namespace Secco2112\Tinify\Traits;

    trait Functions{

        /**
         * Verifica se a variável passada está no formato json.
         *
         * @param mixed $s
         * @return boolean
         */
        protected function isJson($string) {
            @json_decode($string);
            return \json_last_error() === JSON_ERROR_NONE;
        }

        protected function json_decode($json, $assoc = null, $depth = 512, $options = 0) {
            if(!is_bool($assoc)) $assoc = false;

            $data = \json_decode($json, $assoc, $depth, $options);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(
                    'json_decode error: ' . json_last_error_msg()
                );
            }
            return $data;
        }

        protected function json_encode($value, $options = 0, $depth = 512) {
            $json = \json_encode($value, $options, $depth);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(
                    'json_encode error: ' . json_last_error_msg()
                );
            }
            return $json;
        }

        /**
         * Converte uma string json para array se a mesma estiver no formato de json.
         *
         * @param mixed $data
         * @return array
         */
        protected function convertToArrayIfJson(&$data): array {
            if($this->isJson($data)) {
                $data = $this->json_decode($data, true);
            }
            return $data;
        }

        /**
         * Converte uma string json para object se a mesma estiver no formato de json.
         *
         * @param mixed $data
         * @return stdClass
         */
        protected function convertToObjectIfJson(&$data): \stdClass {
            if($this->isJson($data)) {
                $data = $this->json_decode($data);
            }
            return $data;
        }

        /**
         * Extrai conteúdo de um array pela chave, ou retorna o valor padrão passado por parâmetro.
         *
         * @param array $data
         * @param mixed $index
         * @param boolean $default
         * @return mixed
         */
        protected function arrayExtract(array $data, $index, $default = null) {
            if(!$default) $default = false;
            return $data[$index] ?? $default;
        }

    }