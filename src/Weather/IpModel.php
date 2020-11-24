<?php

namespace Marty\Weather;

/**
 * Model for validating IP-addresses
 *
 */
class IpModel
{
    /**
     * @var array  $result for saving the returned data from IP lookup
     * @var array  $json the response to be returned as json
     * @var bool   $isValid true if given ip-address is valid, else false
     * @var string $apiKey api-key to be used to authenticate
     */

    private $result;
    // private $json;
    private $isValid = false;
    private $apiKey;



    /**
     * Checks if ip address is valid or not
     */
    public function validateIpAddress($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            $this->isValid = true;
        }
    }

    /**
     * gets information about ip address
     */
    public function getIpAddressInfo($ipAddress)
    {
        // $accessKey = file_get_contents(ANAX_INSTALL_PATH."/config/private_access_key.php");

        $curl = curl_init("http://api.ipstack.com/".$ipAddress."?access_key=".$this->apiKey."");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($curl);
        curl_close($curl);

        $this->result = json_decode($json, true);
    }

    /**
     * Validates the ip address and populates array
     */
    // public function ipAddressInfoJson($ipAddress)
    // {
    //     if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
    //         $lat = $this->result["latitude"];
    //         $lon = $this->result["longitude"];

    //         $this->json = [
    //             "ip" => $this->result["ip"],
    //             "type" => $this->result["type"],
    //             "country" => $this->result["country_name"],
    //             "region" => $this->result["region_name"],
    //             "city" => $this->result["city"],
    //             "latitude" => $this->result["latitude"],
    //             "longitude" => $this->result["longitude"],
    //             "map" => $lat ? "openstreetmap.org/#map=15/$lat/$lon" : null
    //         ];
    //     } else {
    //         $this->json = [
    //             "ip" => $this->result["ip"],
    //             "validity" => "Not a valid Ip-address"
    //         ];
    //     }
    // }

    /**
     * Sets the api-key
     */
    public function setApiKey($key)
    {
        $this->apiKey = $key;
    }

    // /**
    //  * returns array which is the json response
    //  */
    // public function getJson()
    // {
    //     return $this->json;
    // }

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
