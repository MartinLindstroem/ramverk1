<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "REST Api",
            "mount" => "rest-api",
            "handler" => "\Marty\IpValidator\V2ApiController",
        ],
    ]
];
