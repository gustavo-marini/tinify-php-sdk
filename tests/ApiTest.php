<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Secco2112\Tinify\Config;
use Secco2112\Tinify\Handler\Response\ResponseInterface;
use Secco2112\Tinify\Options;
use Secco2112\Tinify\Tinify;

/**
 * Class TinifyTest.
 */
class TinifyTest extends TestCase
{
    /**
     * Tinify class instance
     *
     * @var \Secco2112\Tinify\Tinify
     */
    private $api;

    public function __construct()
    {
        $config = new Config([
            Options::TINIFYOPT_API_KEY => 'XXXXXXXXXXXXXXXXXXXX'
        ]);

        $this->api = new Tinify;
        $this->api->setConfig($config);
        parent::__construct();
    }

    public function testInstanceTinify()
    {
        $this->assertInstanceOf(Tinify::class, $this->api);
    }

    public function testFromUrl()
    {
        $image_url = 'https://tinypng.com/images/example-orig.png';
        $response = $this->api->fromUrl($image_url);
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

}