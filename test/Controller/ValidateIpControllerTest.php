<?php

namespace Marty\Controller;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class ValidateIpControllerTest extends TestCase
{

    protected $di;


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
    }

    /**
     * Test the route "index".
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testIndexActionGet()
    {
        // Setup the controller
        $controller = new ValidateIpController();
        $controller->setDI($this->di);

        // Setup request object
        $request = $this->di->get("request");
        $page = $this->di->get("page");

        // Set $_GET
        $request->setGet("ipAddress", "127.0.0.1");

        // Call method and get response body
        $res = $controller->indexActionGet();
        $body = $res->getBody();

        $ipRes = $request->getGet("ipAddress");
        $exp = "127.0.0.1";
        
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertEquals($exp, $ipRes);
        $this->assertContains($exp, $body);
    }



    /**
     * Test the route "info".
     */
    // public function testInfoActionGet()
    // {
    //     $controller = new SampleController();
    //     $controller->initialize();
    //     $res = $controller->infoActionGet();
    //     $this->assertContains("db is active", $res);
    // }



    /**
     * Test the route "dump-di".
     */
    // public function testDumpDiActionGet()
    // {
    //     // Setup di
    //     $di = new DIFactoryConfig();
    //     $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

    //     // Use a different cache dir for unit test
    //     $di->get("cache")->setPath(ANAX_INSTALL_PATH . "/test/cache");

    //     // Setup the controller
    //     $controller = new SampleController();
    //     $controller->setDI($di);
    //     $controller->initialize();

    //     // Do the test and assert it
    //     $res = $controller->dumpDiActionGet();
    //     $this->assertContains("di contains", $res);
    //     $this->assertContains("configuration", $res);
    //     $this->assertContains("request", $res);
    //     $this->assertContains("response", $res);
    // }
}
