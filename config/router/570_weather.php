<?php
/**
 * Load the stylechooser as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Info",
            "mount" => "weather",
            "handler" => "\Marty\Weather\WeatherController",
        ],
    ]
];
