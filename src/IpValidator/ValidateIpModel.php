<?php

namespace Marty\IpValidator;

/**
 * Model for validating IP-addresses
 *
 */
class ValidateIpModel
{
    /**
     * @var bool   $isValid For checking if the Ip-address is valid or not
     * @var array  $result for saving the returned data from IP lookup
     */

    private $isValid = false;
    private $result;

    /**
     * Checks if ip address is valid
     */
    public function validateIpAddress($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            $this->isValid = true;
        }
    }

    /**
     * Gets information about ip address
     */
    public function getIpAddressInfo($ipAddress)
    {
        $accessKey = file_get_contents(ANAX_INSTALL_PATH."/config/private_access_key.php");

        $ch = curl_init("http://api.ipstack.com/".$ipAddress."?access_key=".$accessKey."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($ch);
        curl_close($ch);

        $this->result = json_decode($json, true);
    }

    /**
     * returns the result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Returns whether ip address is valid or not
     */
    public function returnIsValid()
    {
        return $this->isValid;
    }
}
