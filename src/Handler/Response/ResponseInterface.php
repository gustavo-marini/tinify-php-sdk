<?php

    namespace Secco2112\Tinify\Handler\Response;

    interface ResponseInterface{
        
        public function getUrl(): string;

        public function getOutputSource(): string;

        public function getOutputSize(): int;

        public function getInputSize(): int;

        public function success(): bool;
        
        public function error(): bool;

        public function download($filename = ''): void;

        public function toRawData(): string;

        public function saveAt($path, $filename): string;

        public function forceOptmize(float $max_optmize_percentage = 5);

    }