<?php

    namespace Secco2112\Tinify;

    use Secco2112\Tinify\Exception\FileDoesNotExists;
    use Secco2112\Tinify\Handler\Request\ResizeRequest;
    use Secco2112\Tinify\Handler\Request\ShrinkRequest;
    use Secco2112\Tinify\Handler\Request\StoreRequest;
    use Secco2112\Tinify\Handler\Response\ShrinkResponse;
    use Secco2112\Tinify\Service\ServiceDefault;

    class Tinify {

        const VERSION = '1.0.0';

        private $_config;
        private $_service = null;

        public function setConfig(Config $config): Tinify {
            $this->_config = $config;
            return $this;
        }

        public function getConfig(): Config {
            return $this->_config;
        }

        public function service(): ServiceDefault {
            if(is_null($this->_service)) {
                $this->_service = ServiceDefault::getInstance()->setApiKey($this->_config->get(Options::TINIFYOPT_API_KEY));
            }
            return $this->_service;
        }

        public function fromFile(string $file_location): ShrinkResponse {
            if(!file_exists($file_location) || !is_file($file_location)) {
                throw new FileDoesNotExists($file_location);
            }

            return (new ShrinkRequest)->fromFile($this, $file_location);
        }

        public function fromUrl(string $url) {
            return (new ShrinkRequest)->fromUrl($this, $url);
        }

        public function fromBlob(string $file_contents) {
            return (new ShrinkRequest)->fromBlob($this, $file_contents);
        }

        public function resize(string $source, array $options) {
            return (new ResizeRequest)->fromSource($source, $options, $this);
        }

        public function store($source): StoreRequest {
            return new StoreRequest($source);
        }

    }