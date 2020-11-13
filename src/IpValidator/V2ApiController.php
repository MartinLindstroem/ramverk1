<?php

namespace Marty\IpValidator;

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
class V2ApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

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

        $data = [
            "url" => $url,
        ];

        $title = "Ip-validator API";

        $this->di->page->add("api/apiV2", $data);

        return $this->di->page->render([
            "title" => $title,
        ]);
    }

    /**
     * method to handle post requests
     */
    public function indexActionPost() : array
    {
        // Deal with the action and return a response.
        $ipAddress = $this->di->request->getPost("ipAddress");
        $model = new ApiValidateIpModel();
        $model->getIpAddressInfo($ipAddress);
        $model->validateIpAddress($ipAddress);
        $json = $model->getJson();

        return [$json];
    }
}
