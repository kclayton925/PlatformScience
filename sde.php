<?php

namespace PlatformScience;

require 'Driver.php';
require 'Address.php';

/* Define some variables. */
$drivers_file = '';
$address_file = '';

$drivers = [];
$addresses = [];

/* Read the args */
if(count($argv) == 3){
    $drivers_file = $argv[1];
    $address_file = $argv[2];
}

/* Read Driver File */
$names = file($drivers_file, FILE_IGNORE_NEW_LINES);

foreach ($names as $name){
    $driver = new Driver($name);
    $drivers[$name] = $driver;
}

/* Read Address File */
$places = file($address_file, FILE_IGNORE_NEW_LINES);

foreach ($places as $place){
    $address = new Address($place);
    $addresses[$place] = $address;
}

/* Calculate SS For all drivers */
foreach ($drivers as $driver){
    $driver->scoreAllAddresses($addresses);
}

/* Calculate  SS for all addresses */
foreach ($addresses as $address){
    $address->scoreAllDrivers($drivers);
}

/* Now perform the column reduction. */
//TODO
