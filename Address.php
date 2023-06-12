<?php

namespace PlatformScience;

class Address
{
    public $address;
    public $drivers;
    public $score;
    public $driver;

    /**
     * @param $address
     */
    public function __construct($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function isEven(): string
    {
        $length = strlen($this->address);
        if ($length % 2 == 0) {
            return true;
        }
        return false;
    }

    /**
     * @param $drivers
     * @return void
     */
    public function scoreAllDrivers($drivers)
    {
        foreach ($drivers as $driver) {
            $score = $driver->score();
            $driver->score = $score;
        }
    }
}