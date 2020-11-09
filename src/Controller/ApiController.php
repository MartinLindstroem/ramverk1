<?php

namespace Marty\Controller;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample JSON controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 */
class ApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    // /**
    //  * The initialize method is optional and will always be called before the
    //  * target method/action. This is a convienient method where you could
    //  * setup internal properties that are commonly used by several methods.
    //  *
    //  * @return void
    //  */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    // }



    /**
     * This is the index method action, it handles:
     * GET METHOD mountpoint
     * GET METHOD mountpoint/
     * GET METHOD mountpoint/index
     *
     * @return array
     */
    public function indexActionGet()
    {
        // Deal with the action and return a response.

        $url = "{$this->di->request->getBaseUrl()}/api";
        // $ipAddress = $this->di->request->getPost("ipAddress");

        // if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
        //     $domainName = gethostbyaddr($ip);
        // }

        $data = [
            "url" => $url,
        ];

        $title = "Ip-validator API";

        $this->di->page->add("api/api", $data);

        return $this->di->page->render([
            "title" => $title,
        ]);
    }


    public function indexActionPost() : array
    {
        // Deal with the action and return a response.
        $ipAddress = $this->di->request->getPost("ipAddress");
        
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            $domainName = gethostbyaddr($ipAddress);

            $json = [
                "ip" => $ipAddress,
                "validity" => "Valid",
                "domain" => $domainName
            ];
        } else {
            $json = [
                "ip" => $ipAddress,
                "validity" => "Not valid"
            ];
        }
        
        return [$json];
    }



    // /**
    //  * This sample method dumps the content of $di.
    //  * GET mountpoint/dump-app
    //  *
    //  * @return array
    //  */
    // public function dumpDiActionGet() : array
    // {
    //     // Deal with the action and return a response.
    //     $services = implode(", ", $this->di->getServices());
    //     $json = [
    //         "message" => __METHOD__ . "<p>\$di contains: $services",
    //         "di" => $this->di->getServices(),
    //     ];
    //     return [$json];
    // }



    // /**
    //  * Try to access a forbidden resource.
    //  * ANY mountpoint/forbidden
    //  *
    //  * @return array
    //  */
    // public function forbiddenAction() : array
    // {
    //     // Deal with the action and return a response.
    //     $json = [
    //         "message" => __METHOD__ . ", forbidden to access.",
    //     ];
    //     return [$json, 403];
    // }
}
