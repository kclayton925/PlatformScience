<?php

namespace PlatformScience;

class Driver
{

    public $name;
    public $addresses;
    public $score;

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function numberOfVowels(): int
    {
        $vowels = ['A', 'E', 'I', 'O', 'U', 'AW', 'EW', 'IW', 'OW', 'UW', 'AY', 'EY', 'IY', 'OY', 'UY'];
        $upper_case_name = strtoupper($this->name);
        $vowel_count = 0;

        foreach ($vowels as $vowel) {
            $vowel_count += substr_count($upper_case_name, $vowel);
        }

        return $vowel_count;
    }

    /**
     * @param array $addresses
     */
    public function scoreAllAddresses(array $addresses)
    {
        foreach ($addresses as $address) {
            $address->score = $this->calculate($address);
            $this->addresses[] = $address;
        }
    }

    /**
     * @param Address $address
     * @return float
     */
    private function calculate(Address $address): float
    {
        $score = 0;

        if ($address->isEven()) {
            $score = $this->numberOfVowels() * 1.5;
        } else {
            $score = $this->numberOfConsonants() * 1.0;
        }

        //Check factors
        if ($this->hasCommonFactors(strlen($address->name))) {
            $score = $score * 1.5;
        }

        return $score;
    }

    /**
     * @return int
     */
    private function numberOfConsonants(): int
    {
        $name = $this->name;
        // Remove Whitespace
        $name = str_replace(' ', '', $name);
        $length = strlen($name);
        $length -= $this->numberOfVowels();
        return $length;
    }

    /**
     * @param int $address_length
     * @return bool
     */
    private function hasCommonFactors(int $address_length): bool
    {
        $address_factors = $this->factor($address_length);
        $driver_factors = $this->factor(strlen($this->name));

        foreach ($address_factors as $factor) {
            if ($factor != 1) {
                if (in_array($factor, $driver_factors)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param $number
     * @return array
     */
    private function factor($number): array
    {
        $factors = [];
        for ($i = 1; $i <= $number; $i++) {
            if ($number % $i == 0)
                $factors[] = $i;
        }
        return $factors;
    }
}