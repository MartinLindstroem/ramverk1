<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP validator.",
            "mount" => "validate-ip",
            "handler" => "\Marty\IpValidator\V2ValidateIpController",
        ],
    ]
];
