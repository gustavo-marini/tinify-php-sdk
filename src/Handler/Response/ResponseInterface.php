<?php

    namespace Secco2112\Tinify\Handler\Response;

    interface ResponseInterface{
        
        public function getOutputSource(): string;

        public function success(): bool;
        
        public function error(): bool;

    }