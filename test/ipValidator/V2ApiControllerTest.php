<?php

namespace Marty\IpValidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class V2ApiControllerTest extends TestCase
{
    
    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // Use a different cache dir for unit test
        $this->di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new V2ApiController();
        $this->controller->setDI($this->di);
        // $this->controller->initialize();
    }



    /**
     * Test the route "index".
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testIndexActionGet()
    {
        // Setup request object
        $request = $this->di->get("request");
        $page = $this->di->get("page");

        $request->setPost("ip", "127.0.0.1");

        $res = $this->controller->indexActionGet();
        $body = $res->getBody();

        $exp = "Validate an IP address";
        $this->assertContains($exp, $body);
    }



    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPostValidIp()
    {
        // Setup request object
        $request = $this->di->get("request");
        // $page = $this->di->get("page");

        $request->setPost("ipAddress", "8.8.8.8");

        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];

        $this->assertContains("8.8.8.8", $json["ip"]);
        $this->assertContains("ipv4", $json["type"]);
        $this->assertContains("California", $json["region"]);
    }



    /**
     * Test the route "index" with POST.
     */
    public function testIndexActionPostInvalidIp()
    {
        // Setup request object
        $request = $this->di->get("request");

        $request->setPost("ipAddress", "12.3.45");

        $res = $this->controller->indexActionPost();
        $this->assertInternalType("array", $res);

        $json = $res[0];

        $this->assertContains("12.3.45", $json["ip"]);
        $this->assertContains("Not a valid Ip-address", $json["validity"]);
    }
}
