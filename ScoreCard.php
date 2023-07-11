<?php

namespace PlatformScience;

class ScoreCard
{
    private $addresses;
    private $drivers;
    public $scores;
    private $max_x;
    private $max_y;
    private $max_score;

    public function __construct(array $addresses, array $drivers)
    {
        $this->addresses = $addresses;
        $this->drivers = $drivers;
    }

    public function scoreAll()
    {
        /* Build an empty score array */
        $width = count($this->drivers);
        $height = count($this->addresses);
        $score = [];

        for ($index = 0; $index < $height; $index++) {
            $row = array_fill(0, $width, 0);
            $score[$index] = $row;
        }

        /* Score each possible combinations. */
        for ($address_index = 0; $address_index < count($score); $address_index++) {
            for ($driver_index = 0; $driver_index < count($score[$address_index]); $driver_index++) {
                $score[$address_index][$driver_index] = $this->scoreCell($address_index, $driver_index);
                if ($score[$address_index][$driver_index] > $this->max_score) {
                    $this->max_score = $score[$address_index][$driver_index];
                    $this->max_x = $driver_index;
                    $this->max_y = $address_index;
                }
            }
        }

        $this->scores = $score;
    }

    public function max(): float
    {
        if (is_null($this->max_score)) {
            $this->scoreAll();
        }
        return $this->max_score;
    }

    public function getMaxCombination()
    {
        if (is_null($this->max_score)) {
            $this->scoreAll();
        }

        $drivers = $this->orderArray($this->drivers, $this->max_x);
        $addresses = $this->orderArray($this->addresses, $this->max_y);

        return [$addresses, $drivers];
    }

    private function orderArray(array $input_array, $start_index): array
    {
        if ($start_index > 0) {
            if ($start_index > count($input_array)) {
                throw new \Exception("Array index does not exist.");
            }
            $first_part = array_slice($input_array, 0, $start_index);
            $second_part = array_slice($input_array, $start_index);
            $input_array = array_merge($second_part, $first_part);
        }
        return $input_array;
    }

    private function scoreCell(int $address_index, int $driver_index): float
    {
        $score = 0;
        $addresses = $this->addresses;
        $drivers = $this->drivers;


        $addresses = $this->orderArray($addresses, $address_index);

        $drivers = $this->orderArray($drivers, $driver_index);

        for ($a = 0; $a < count($addresses); $a++) {
            if (array_key_exists($a, $drivers)) {
                $value = $drivers[$a]->calculate($addresses[$a]);
                $score += $value;
            }
        }

        return $score;
    }
}