<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "REST Api",
            "mount" => "api",
            "handler" => "\Marty\Controller\ApiController",
        ],
    ]
];
