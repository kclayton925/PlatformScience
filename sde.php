<?php

namespace PlatformScience;

require 'Driver.php';
require 'Address.php';
require 'ScoreCard.php';

/* Define some variables. */
$drivers_file = '';
$address_file = '';

$drivers = [];
$addresses = [];

/* Read the args */
if (count($argv) == 3) {
    $drivers_file = $argv[2];
    $address_file = $argv[1];
}

/* Read Driver File */
$names = file($drivers_file, FILE_IGNORE_NEW_LINES);

/* Make objects for the drivers */
foreach ($names as $name) {
    $driver = new Driver($name);
    $drivers[] = $driver;
}

/* Read Address File */
$places = file($address_file, FILE_IGNORE_NEW_LINES);

/* Make objects for the addresses */
foreach ($places as $place) {
    $address = new Address($place);
    $addresses[] = $address;
}

$score_card = new ScoreCard($addresses, $drivers);
$score_card->scoreAll();

$kris = 0;

$max = $score_card->getMaxCombination();
$max_addresses = $max[0];
$max_drivers = $max[1];


/* Output the results */
for ($i = 0; $i < count($drivers); $i++) {
    echo 'Diver: ' . $max_drivers[$i]->name . ' is delivering to: ' . $max_addresses[$i]->address . "\r\n";
}

echo "----------------------------------------\r\n";
echo "Total SS: " . $score_card->max() . "\r\n";
