<?php

    namespace Secco2112\Tinify\Handler\Response;

    interface ResponseInterface{
        
        public function getOutputSource(): string;

        public function success(): bool;
        
        public function error(): bool;

        public function download($filename = ''): void;

        public function toRawData(): string;

        public function saveAt($path, $filename): string;

    }