<?php

namespace App\BankAccount;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
class Balance
{
    /**
     * @var float|int
     */
    private $amount = 0;

    /**
     * @var string
     */
    private $currency = 'GBP';

    /**
     * @param float  $amount
     * @param string $currency
     */
    public function __construct($amount, $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param float|int $amount
     */
    public function increase($amount)
    {
        $this->amount += $amount;
    }

    /**
     * @param float|int $amount
     */
    public function decrease($amount)
    {
        $this->amount -= $amount;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
