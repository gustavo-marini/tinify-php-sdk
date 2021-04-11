<?php

    namespace Secco2112\Tinify\Service;

    interface ServiceInterface
    {
        const REQUEST_METHOD_GET = 'GET';

        const REQUEST_METHOD_POST = 'POST';

        const REQUEST_METHOD_PUT = 'PUT';

        const REQUEST_METHOD_HEAD = 'HEAD';

        const REQUEST_METHOD_DELETE = 'DELETE';

        const REQUEST_METHOD_PATCH = 'PATCH';


        public function post(string $uri, $body = null);

        public function put(string $uri, $body = null);

        public function patch(string $uri, $body = null);

        public function get(string $uri);

        public function delete(string $uri, $body = null);

        public function head(string $uri);

        public function request(string $method, string $uri, $body = null);

    }