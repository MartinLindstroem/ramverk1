<?php

namespace Marty\IpValidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A controller for validating ip addresses
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class V2ValidateIpController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     */
    public function indexActionGet()
    {
        $model = new ValidateIpModel();

        $ipAddress = $this->di->request->getGet("ipAddress");
        // $this->di->session->set("ipAddress", $ipAddress);

        $model->validateIpAddress($ipAddress);
        $model->getIpAddressInfo($ipAddress);

        $isValid = $model->returnIsValid();
        $result = $model->getResult();

        $userIpAddr = $this->di->request->getServer("REMOTE_ADDR");

        $data = [
            "result" => $result ?? null,
            "isValid" => $isValid ?? null,
            "userIpAddr" => $userIpAddr,
        ];

        $title = "Validera Ip-adress";

        $this->di->page->add("ip-validator/ip-validatorV2", $data);

        return $this->di->page->render([
            "title" => $title,
        ]);
    }
}
