<?php

namespace PlatformScience;

class Address
{
    public $address;

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
//    public function scoreAllDrivers($drivers)
//    {
//        $total_score = 0;
//        $this->drivers = $drivers;
//        foreach ($drivers as $driver) {
//            $score = $driver->calculate($this);
//            $driver->score = $score;
//            $total_score += $score;
//        }
//        $this->score = $total_score;
//    }
}