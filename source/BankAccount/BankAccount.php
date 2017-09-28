<?php

namespace App\BankAccount;

/**
 * @copyright 2016 Jarosław Stańczyk <jaroslaw@stanczyk.co.uk>. All rights reserved.
 */
interface BankAccount
{
    /**
     * @return float
     */
    public function balance();

    /**
     * @return float
     */
    public function overdraft();

    /**
     * @param float $amount
     */
    public function withdraw($amount);

    /**
     * @param float $amount
     */
    public function deposit($amount);
}
